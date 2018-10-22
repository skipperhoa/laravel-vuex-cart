<template>
    <div class="login-kh">
        <div class="alert alert-danger" v-if="error">
            <p>There was an error, unable to sign in with those credentials.</p>
        </div>
        <form autocomplete="off" @submit.prevent="login" method="post" id="form-kh">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" placeholder="Enter password" v-model="password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default">Sign in</button>
            </div>
        </form>
    </div>
</template>
<script>
  export default {
    data(){
      return {
        email: null,
        password: null,
        error: false
      }
    },
    methods: {
      login(){
        var app = this
        this.$auth.login({
            params: {
              email: app.email,
              password: app.password
            }, 
            success: function (response) {
               // console.log(response);
            },
            error: function () {},
            rememberMe: true,
            redirect: '/cart-products',
            fetchUser: true,
        });       
      },
    }
  } 
</script>