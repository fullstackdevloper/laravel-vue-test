<template>
    <div class="">
        <div class="container py-5 pt-2">
            <div class="row">
                <div class="col-lg-12 p-5 pb-0 pt-0">
                    <h1> <font-awesome-icon icon="fa-solid fa-tachometer" /><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</h1>
                    <hr />
                </div>
            </div>
            <div class="row">
                <template v-if="1 == 2">
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
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-5 pt-0 mb-8">
                    <survey @cancel="activeTab = ''" @sumited="submitSurvey" />
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
import survey from './survey.vue'
import { mapMutations, mapActions, mapGetters } from 'vuex'

export default {
    data: () => ({
        loading: false,
        activeTab: '',
        submited: false
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
        submitSurvey() {
            this.submited = true;
            this.activeTab = '';
            this.$notify({
                title: 'Survey',
                text: 'Survey submited successfully',
                type: 'success',
            });
            this.$router.push('/result');
        }
    },
}
</script>