<template>
    <div class="">
        <nav class="nav bg-dark justify-content-center">
            <a class="nav-link text-white" href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
            <a class="nav-link text-white" href="#" @click="logout">Logout <i class="fa fa-sign-out"
                    aria-hidden="true"></i></a>
        </nav>

        <div class="container py-5">
            <div class="row">
                <div class="col-lg-12 p-5">
                    <h1> <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</h1>
                    <hr />
                </div>
            </div>
            <div class="row">
                <template v-if="authUser.survey && !authUser.survey.length">
                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2 p-2">
                        <a class="text-decoration-none" href="#" @click="activeTab = 'survey'">
                            <div class="card p-3 shadow bg-light text-center border-0">
                                <div class="card-body">
                                    <i class="fa fa-edit fa-2x" aria-hidden="true"></i>
                                    <hr />
                                    <p class="card-title lead">Survey</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </template>
                <template v-else>
                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2 p-2">
                        <a class="text-decoration-none" href="#" @click="activeTab = 'result'">
                            <div class="card p-3 shadow bg-light text-center border-0">
                                <div class="card-body">
                                    <i class="fa fa-image fa-2x" aria-hidden="true"></i>
                                    <hr />
                                    <p class="card-title lead">Result</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    </template>
                <template v-if="activeTab == 'survey'">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 p-2 mb-8">
                        <survey />
                    </div>
                </template>
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
import survey from './survey.vue'
import { mapMutations, mapActions, mapGetters } from 'vuex'

export default {
    data: () => ({
        loading: false,
        activeTab: '',
    }),
    components: {
        survey
    },
    computed: {
        ...mapGetters('survey', ['questions']),
        ...mapGetters('user', ['authUser']),
    },
    created() {
        this.getQuestions();
        this.getUserDetail();
    },

    watch: {
    },

    methods: {
        ...mapActions('survey', ['fetchQuestions']),
        ...mapActions('user', ['fetchUserDetail']),
        ...mapMutations('auth', ['removeAuth']),
        getQuestions() {
            this.fetchQuestions();
        },
        getUserDetail() {
            this.fetchUserDetail();
        },
        logout() {
            this.removeAuth();
            this.$router.push('/login');
        }
    },
}
</script>