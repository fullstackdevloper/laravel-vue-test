<template>
    <div class="">
        <nav class="nav bg-dark justify-content-center">
            <a class="nav-link text-white" href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
            <a class="nav-link text-white" href="#" @click="logout">Logout <i class="fa fa-sign-out" aria-hidden="true"></i></a>
        </nav>

        <div class="container py-5">
            <div class="row">
                <div class="col-lg-12 p-5">
                    <h1> <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</h1>
                    <hr />
                </div>
            </div>
            <div class="row">

                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2 p-2">
                    <a class="text-decoration-none" href="#">
                        <div class="card p-3 shadow bg-light text-center border-0">
                            <div class="card-body">
                                <i class="fa fa-edit fa-2x" aria-hidden="true"></i>
                                <hr />
                                <p class="card-title lead">Survey</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2 p-2">
                    <a class="text-decoration-none" href="#">
                        <div class="card p-3 shadow bg-light text-center border-0">
                            <div class="card-body">
                                <i class="fa fa-image fa-2x" aria-hidden="true"></i>
                                <hr />
                                <p class="card-title lead">Result</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <footer class="footer fixed-bottom bg-dark">
            <div class="row text-center p-3">
                <p class="small text-muted">Develop & Design by fullstack</p>
            </div>
        </footer>
    </div>
</template>
 
<script>
import form from 'vuejs-form'
import { mapMutations } from 'vuex'

export default {
    data: () => ({
        loading: false,
        authenticated: localStorage.getItem('token'),
    }),

    watch: {
    },

    methods: {
        ...mapMutations('auth', ['removeAuth']),
        logout() {
            this.removeAuth();
            this.$router.push('/login');
        }
    },
}
</script>