<?php

namespace App\Http\Controllers;

use App\CVFile;
use Smalot\PdfParser\Parser;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class CVFileController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $filePath = storage_path('cv\test.pdf');
        $parser = new Parser();
        try {
            $pdf = $parser->parseFile($filePath);
            // Retrieve all pages from the pdf file.
            $pages = $pdf->getPages();
            // Loop over each page to extract text.
            echo gettype($pages). "<br>";
            $cvDataList = [];
            // get cv data for each page
            foreach ($pages as $page) {
                $text = $page->getText();
                $list = $this->splitNewLine($text);
                $cvDataList[] = $this->getObjectFormData($list);
            }
            $this->saveCVInfo($cvDataList);
        } catch (Exception $e) {
            \Log::info('Caught exception: '.  $e->getMessage(). "\n");
        }
    }

    /**
     * Store the data
     *
     * @param [type] $data
     * @return void
     */
    public function saveCVInfo($data)
    {
        $cv_info = $this->getAllCVDataList($data)->toArray();
        CVFile::create($cv_info);
    }

    /**
     * Get all data list in all pages of CV file
     *
     * @param [array] $data
     * @return object
     */
    public function getAllCVDataList($data)
    {
        $dataList = [];
        foreach ($data as $key => $item) {
            foreach ($item as $index => $value) {
                $dataList[] = $value;
            }
        }
        return $this->getCVFileData($dataList);
    }
    
    /**
     * Convert to CVFile object data
     *
     * @param [array] $data
     * @return object
     */
    public function getCVFileData($data)
    {
        $cvData = new CVFile();
        foreach ($data as $key => $item) {
            $item = json_decode($item, true);
            $label = trim(preg_replace('/[\t]/', "", $item[0]));
            $table_column = config('cvfiles.title.'.$label);
            $content = $item[1];
            if ($table_column) {
                $cvData->$table_column = $content;
            }
        }
        return $cvData;
    }

    /**
     * Split NewLine for the string
     *
     * @param [String] $text
     * @return array
     */
    public function splitNewLine($text)
    {
        $code=preg_replace('/\n$/', '', preg_replace('/^\n/', '', preg_replace('/[\r\n]+/', "\n", $text)));
        return explode("\n", $code);
    }

    /**
     * Get string to array data list
     *
     * @param [string] $data
     * @return [array] $dataList
     */
    public function getObjectFormData($data)
    {
        $dataList = $dataList1 = [];
        $search1 = "[a-zA-Z0-9]+"; // for char found
        $search2 = "\:"; // for row title with info 【name : John】
        foreach ($data as $key => $value) {
            // // For paragraph data
            // if (preg_match("/{$search1}/i", $value)) {
            //     $dataList1[] = $value;
            // }
            // For info 【name : John】
            $value = preg_replace('/[\t]/', '', $value);
            if (preg_match("/{$search2}/i", $value)) {
                $content = explode(":", $value, 2);
                $dataList[] = json_encode($content);
            }
        }
        return $dataList;
    }
}
