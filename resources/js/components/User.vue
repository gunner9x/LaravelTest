<template>
    <div>
        <h2>Users</h2>
        <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
            <a class="page-link" href="#" @click="fetchusers(pagination.prev_page_url)">Previous</a>
        </li>

        <li class="page-item disabled">
            <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
        </li>

        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
            <a class="page-link" href="#" @click="fetchusers(pagination.next_page_url)">Next</a>
        </li>
      </ul>
    </nav>
    <table class="table table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Full Name</td>
                    <td>Email Adress</td>
                    <td>Date Added</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" v-bind:key="user.id">
                    <td>{{ user.id }}</td>
                    <td @click="edituser(user)">{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.created_at }}</td>
                    <td>
                        <!-- <button @click="deleteuser(user.id)" class="btn btn-danger">Delete</button> -->
                    </td>
                </tr>
            </tbody>
    </table>


    </div>
</template>

<script>
export default {
  data() {
    return {
      users: [],
      user: {
        id: '',
        name: '',
        email: '',
        created_at: ''
      },
      user_id: '',
      pagination: {},
      edit: false
    };
  },

  created() {
    this.fetchusers();
  },

  methods: {
    fetchusers(page_url) {
      let vm = this;
      page_url = page_url || '/api/users';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.users = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };

      this.pagination = pagination;
    },
    deleteuser(id) {
      if (confirm('Are You Sure?')) {
        fetch(`api/user/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('user Removed');
            this.fetchusers();
          })
          .catch(err => console.log(err));
      }
    },
    adduser() {
      if (this.edit === false) {
        // Add
        fetch('api/user', {
          method: 'post',
          body: JSON.stringify(this.user),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('user Added');
            this.fetchusers();
          })
          .catch(err => console.log(err));
      } else {
        // Update
        fetch('api/user', {
          method: 'put',
          body: JSON.stringify(this.user),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('user Updated');
            this.fetchusers();
          })
          .catch(err => console.log(err));
      }
    },
    edituser(user) {
      this.edit = true;
      this.user.id = user.id;
      this.user.user_id = user.id;
      this.user.name = user.name;
      this.user.email = user.email;
    },
    clearForm() {
      this.edit = false;
      this.user.id = null;
      this.user.user_id = null;
      this.user.name = '';
      this.user.email = '';
    }
  }
};
</script>
