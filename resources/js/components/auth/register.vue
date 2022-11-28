<template>
  <div class="container">
    <div class="row m-5 no-gutters shadow-lg align-items-center rounded">
      <div class="col-md-6 d-none d-md-block">
        <img
          src="https://images.unsplash.com/photo-1566888596782-c7f41cc184c5?ixlib=rb-1.2.1&auto=format&fit=crop&w=2134&q=80"
          class="img-fluid" style="min-height:100%;" />
      </div>
      <div class="col-md-6 bg-white p-5">
        <h3 class="pb-3">Sign Up</h3>
        <div class="form-style">
          <form>
            <div class="form-group pb-3">
              <input type="text" placeholder="Name" class="form-control" id="name" aria-describedby="name"
                v-model='form.name'>
              <span v-if="form.errors().has('name')" v-text="form.errors().get('name')" class="text-danger"></span>
            </div>
            <div class="form-group pb-3">
              <input type="email" placeholder="Email" class="form-control" id="email" aria-describedby="emailHelp"
                v-model='form.email'>
              <span v-if="form.errors().has('email')" v-text="form.errors().get('email')" class="text-danger"></span>
            </div>
            <div class="form-group pb-3">
              <input type="password" placeholder="Password" class="form-control" id="password" v-model='form.password'>
              <span v-if="form.errors().has('password')" v-text="form.errors().get('password')"
                class="text-danger"></span>
            </div>
            <div class="form-group pb-3">
              <input type="password" placeholder="Confirm Password" class="form-control" id="password_confirmation"
                v-model='form.password_confirmation'>
              <span v-if="form.errors().has('password_confirmation')"
                v-text="form.errors().get('password_confirmation')" class="text-danger"></span>
            </div>
            <div class="pb-2">
              <button type="button" class="btn btn-dark w-100 font-weight-bold mt-2" :disabled='form.empty()'
                @click='register'>Submit</button>
            </div>
          </form>
          <div class="pt-4 text-center">
            Already Member.
            <router-link to="/login" active-class="active">Login</router-link>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>
  
<script>
import form from 'vuejs-form'

export default {
  data: () => ({
    loading: false,
    form: form({
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
    })
      .rules({
        name: 'min:5|required',
        email: 'email|min:5|required',
        password: 'required|min:5|confirmed'
      })
      .messages({
        'email.email': 'Email field must be an email',
        'password.confirmed': 'Whoops, :attribute value does not match :confirmed value',
      }),
  }),

  watch: {
    ['form.data']: {
      deep: true,
      immediate: false,
      handler: 'onFormChange'
    }
  },

  methods: {
    onFormChange(after, before) {
      this.form.validate();
    },
    register() {
      if (this.form.validate().errors().any()) return;
    }
  },
}
</script>

<style scoped="true">
body {
  background: #c9ccd1;
}
div#app {
    height: 100vh;
    width: 100%;
    position: relative;
    display: flex;
    align-items: center;
}
#app img {
    max-height: 600px;
    width: 100%;
    object-fit: cover;
}

.form-style input {
  border: 0;
  height: 50px;
  border-radius: 0;
  border-bottom: 1px solid #ebebeb;
}

.form-style input:focus {
  border-bottom: 1px solid #007bff;
  box-shadow: none;
  outline: 0;
  background-color: #ebebeb;
}

.sideline {
  display: flex;
  width: 100%;
  justify-content: center;
  align-items: center;
  text-align: center;
  color: #ccc;
}

button {
  height: 50px;
}

.sideline:before,
.sideline:after {
  content: '';
  border-top: 1px solid #ebebeb;
  margin: 0 20px 0 0;
  flex: 1 0 20px;
}

.sideline:after {
  margin: 0 0 0 20px;
}
</style>