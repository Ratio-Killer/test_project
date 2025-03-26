<template>
  <div>
    <div class="container">
      <div class="users-wrapper">
        <div class="users-list-wrapper">
          <h1 class="title first">User's list</h1>
          <ul class="users-list">
            <li class="list" v-for="user in users" :key="user.id">
              <div class="user">
                <img :src="user.photo" alt="Preview" class="user-avatar"/>
                <div class="user-block">
                  <span class="bold">Name:&nbsp </span>
                  <span>{{ user.name }}</span>
                </div>
                <div class="user-block">
                  <span class="bold">Position:&nbsp </span>
                  <span> {{ user.position }}</span>
                </div>
                <div class="user-block">
                  <span class="bold">Email:&nbsp </span>
                  <span> {{ user.email }}</span>
                </div>
                <div class="user-block">
                  <span class="bold">Phone:&nbsp </span>
                  <span> {{ user.phone }}</span>
                </div>

              </div>
            </li>
          </ul>
          <div class="show-more-button">
            <button @click="loadUsers" :disabled="loading || !nextURL">Show more</button>
          </div>
          <span class="page">Current page: {{ currentPage }}</span>
        </div>
        <div class="user-form-wrapper">
          <h2 class="title">Add user</h2>
          <div v-if="message">
            <span class="message">{{ message }}&nbsp</span>
            <span class="message">Your id: {{ userId }}</span>
          </div>
          <form class="user-post-form" @submit.prevent="addUser">

            <div class="file-upload">
              <label for="fileInput" class="file-label">
                <div class="upload-box">
                  <span v-if="!previewImage">Upload a photo</span>
                  <img v-else :src="previewImage" alt="Preview" class="preview-image"/>
                </div>
                <input type="file" id="fileInput" @change="handleFileUpload" accept="image/*" class="input-hidden"
                       required/>
              </label>
            </div>

            <input class="input-form" type="text" v-model="newUser.name" placeholder="Name" required/>
            <input class="input-form" type="email" v-model="newUser.email" placeholder="Email" required/>
            <input class="input-form" type="text" v-model="newUser.phone" placeholder="Phone" required/>

            <select v-model="newUser.position" class="input-form" required>
              <option disabled value="">Choose position</option>
              <option v-for="position in positions" :key="position.id" :value="position.id">
                {{ position.name }}
              </option>
            </select>


            <button type="submit">Sing up</button>
          </form>

        </div>
      </div>
      <div class="user-wrapper" v-if="user">
        <h2 class="title">Your profile</h2>
        <div class="user">
          <img :src="user.photo" alt="Preview" class="user-avatar"/>
          <div class="user-block">
            <span class="bold">Name:&nbsp </span>
            <span>{{ user.name }}</span>
          </div>
          <div class="user-block">
            <span class="bold">Position:&nbsp </span>
            <span> {{ user.position }}</span>
          </div>
          <div class="user-block">
            <span class="bold">Email:&nbsp </span>
            <span> {{ user.email }}</span>
          </div>
          <div class="user-block">
            <span class="bold">Phone:&nbsp </span>
            <span> {{ user.phone }}</span>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      users: [],
      user: null,
      positions: [],
      loading: false,
      currentPage: 1,
      nextPage: 1,
      count: 6,
      newUser: {
        name: '',
        email: '',
        phone: '',
        position: '',
        photo: null
      },
      message: '',
      userId: null,
      nextURL: null,
      previewImage: null,
      selectedFile: null,
    }
  },
  methods: {
    async loadUsers() {
      if (this.loading || (this.nextPage > 1 && !this.nextURL)) return;
      this.loading = true;

      try {
        const apiUrl = import.meta.env.VITE_API_URL;
        const response = await axios.get(`${apiUrl}/users?page=${this.nextPage}&count=${this.count}`);

        if (response.data.data.users.length > 0) {
          this.users.push(...response.data.data.users);
          this.currentPage = this.nextPage;
          this.nextPage++;
          this.nextURL = response.data.data.links.next_url;
        }
      } catch (error) {
        console.error('Error while loading users', error);
      } finally {
        this.loading = false;
      }
    },
    async getPositions() {
      this.loading = true;
      try {
        const apiUrl = import.meta.env.VITE_API_URL;
        const response = await axios.get(`${apiUrl}/positions`);

        if (response.data.data.positions.length > 0) {
          this.positions.push(...response.data.data.positions);
        }
      } catch (error) {
        console.error('Error while loading positions', error);
      } finally {
        this.loading = false;
      }
    },
    async getUser() {

      try {
        const apiUrl = import.meta.env.VITE_API_URL;
        const response = await axios.get(`${apiUrl}/users/${this.userId}`);
        console.log(response)

        this.user = response.data.data.user;
      } catch (error) {
        console.error('Error while loading users', error);
      }
    },
    async addUser() {
      const formData = new FormData();
      formData.append('name', this.newUser.name);
      formData.append('email', this.newUser.email);
      formData.append('phone', this.newUser.phone);
      formData.append('position_id', this.newUser.position);

      if (this.selectedFile) {
        formData.append('photo', this.selectedFile);
      }

      const apiUrl = import.meta.env.VITE_API_URL;

      try {
        const response = await axios.post(`${apiUrl}/users`, formData, {});
        console.log(response)

        this.message = response.data.data.message;
        this.userId = response.data.data.user_id;

        this.resetForm();
        this.getUser();
      } catch (error) {
        console.error('Error while adding user', error);
      }
    },

    handleFileUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.selectedFile = file;
        const reader = new FileReader();
        reader.onload = (e) => {
          this.previewImage = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    },

    resetForm() {
      this.newUser = {name: '', email: '', phone: '', role: '', avatar: null};
    }
  },
  mounted() {
    this.loadUsers();
    this.getPositions();
  }
};
</script>

<style scoped>


.container {
  max-width: 100%;
}

.page {
  display: block;
  margin: 10px 0;
  padding: 0 5%;
}

.title {
  display: flex;
  font-size: 21px;
  align-items: end;
  justify-content: flex-start;
  margin: 44px 0;
}

.title.first {
  padding: 0 5%;

}

.bold {
  font-weight: 700;
}

.users-wrapper {
  display: flex;
  max-width: 100%;
  width: 100%;
  box-sizing: border-box;
  padding: 0 5%;
}

.users-list-wrapper {
  width: 60%;
}

.user-form-wrapper {
  width: 40%;
}

.list {
  list-style: none;
}

.users-list {
  height: auto;
  padding: 5%;
  overflow-y: scroll;
  max-height: 456px;
  min-height: 456px;
  min-width: 476px;
}

.input-form {
  margin: 12px 0;
  align-items: center;
  border-radius: 12px;
  cursor: pointer;
  display: flex;
  padding: 12px 20px;
  font-weight: bold;
  color: #fff;
}

.input-form::placeholder {
  text-transform: uppercase;

}

.user {
  display: flex;
  flex-direction: column;
  margin: 17px 0;
}

.user-block {
  display: flex;
}

.user-post-form {
  display: flex;
  flex-direction: column;
}

.file-upload {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.file-label {
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
}

.upload-box {
  width: 70px;
  height: 70px;
  border: 2px dashed #ccc;
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  font-size: 12px;
  color: #777;
  background-color: #f9f9f9;
  overflow: hidden;
}

.preview-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.input-hidden {
  display: none;
}

.user-avatar {
  height: 70px;
  width: 70px;
  min-height: 70px;
  min-width: 70px;
  max-height: 70px;
  max-width: 70px;
}

.show-more-button {
  padding: 0 5%;
}

.user-wrapper {
  padding: 0 5%;
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
}

@media screen and (max-width: 990px) {
  .users-wrapper {
    flex-direction: column;
  }


  .users-list-wrapper,
  .user-form-wrapper {
    width: 100%;
  }

}
</style>
