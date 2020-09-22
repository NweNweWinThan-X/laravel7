<template>
  <div>
    <h3 class="text-center">All Posts</h3>
    <br />

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Description</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="post in posts.data" :key="post.id">
          <td>{{ post.id }}</td>
          <td>{{ post.title }}</td>
          <td>{{ post.description }}</td>
          <td>{{ post.created_at }}</td>
          <td>{{ post.updated_at }}</td>
          <td>
            <div class="btn-group" role="group">
              <router-link
                :to="{name: 'edit', params: { id: post.id }}"
                class="btn btn-sm btn-outline-primary"
              >Edit</router-link>
              <button
                class="btn btn-sm btn-outline-danger border-left-0"
                @click="deletePost(post.id)"
              >Delete</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <pagination :data="posts" @pagination-change-page="getPostsByPageId"></pagination>
  </div>
</template>
 
<script>
export default {
  data() {
    return {
      posts: {},
    };
  },
  created() {
    this.getPostsByPageId();
  },
  methods: {
    getPost() {
      this.axios
        .get("/api/posts")
        .then((response) => {
          console.log(response.data);
          this.posts = response.data;
        })
        .catch((error) => console.log(error));
    },
    getPostsByPageId(page) {
      if (typeof page === "undefined") {
        page = 1;
      }

      this.$http
        .get("/api/posts?page=" + page)
        .then((response) => {
          this.posts = response.data;
        })
        .catch((error) => console.log(error));
    },
    deletePost(id) {
      this.axios
        .delete(`/api/post/delete/${id}`)
        .then((response) => {
          // find index of your object
          let i = this.posts.map((item) => item.id).indexOf(id);
          // remove
          this.posts.splice(i, 1);
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>
