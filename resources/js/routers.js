import AllPosts from './post-components/AllPost';
import AddPost from './post-components/AddPost';
import EditPost from './post-components/EditPost';
 
export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllPosts
    },
    {
        name: 'add',
        path: '/add',
        component: AddPost
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditPost
    }
];
