<template>
    <div class="">

        <div class="container py-5 pt-2">
            <div class="row">
                <div class="col-lg-12 p-5 pt-0 pb-0">
                    <h1> <font-awesome-icon icon="fa fa-square-poll-vertical" /> Last Survey Result</h1>
                    <hr />
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-5 pt-0 mb-8">
                    <div v-for="(opt, index) in authUser.survey" :key="index">
                        <template v-if="1 == 1">
                            <label :for="opt.question.name">{{ index + 1 }}: {{ opt.question.name }}</label>
                            <div v-for="(option, n)  in opt.question.options" :key="n">
                                <label class="pl-3" :for="option.name">({{ n + 1 }}) : {{ option.name }}</label>
                                <template v-if="!opt.answerType && opt.selectedOption.id == option.id">
                                    <span class="text-red-600 pl-2">
                                        (<font-awesome-icon icon="fa-solid fa-xmark" />)
                                    </span>
                                </template>
                                <template v-if="opt.answerType && opt.selectedOption.id == option.id">
                                    <span class="text-green-600 pl-1">
                                        (<font-awesome-icon icon="fa-solid fa-check" />)
                                    </span>
                                </template>
                            </div>
                            <br>
                            <template v-if="index == 9">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2 p-2">
                                        <button type="button" class="btn btn-danger w-100 font-weight-bold mt-2"
                                            @click='backtoSurvey'>Back to survey</button>
                                    </div>
                                </div>
                            </template>
                        </template>
                    </div>
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
        backtoSurvey() {
            this.$router.push('/survey');
        }
    },
}
</script>