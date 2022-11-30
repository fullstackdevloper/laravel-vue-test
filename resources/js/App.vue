<template>
  <nav class="nav bg-dark justify-content-center" v-if="isAuthenticated">
    <a class="nav-link text-white" href="#" @click="returnToHome"><font-awesome-icon icon="fa-solid fa-home" /> Home</a>
    <a class="nav-link text-white" href="#" @click="logout">Logout <font-awesome-icon icon="fa-solid fa-sign-out" /></a>
  </nav>
  <router-view />
  <notifications />
</template>
  
<script>
import { mapMutations, mapActions, mapGetters } from 'vuex'
export default {
  name: 'App',

  data: () => ({
    //
  }),
  computed: {
    ...mapGetters('auth', ['isAuthenticated']),
  },
  methods: {
    ...mapMutations('auth', ['removeAuth']),
    logout() {
      this.removeAuth();
      this.$router.push('/login');
      this.$notify({
        title: 'Logout',
        text: 'User Logout successfully',
        type: 'warn',
      });
    },
    returnToHome() {
      this.$router.push('/survey');
    }
  }
}
</script>
  