<template>
    <div class="mb-5">
        <div v-for="(opt, index) in surveyQuestions" :key="index">
            <template v-if="index < 5 || (showAll == true)">
                <label :for="opt.name">{{ opt.id }}: {{ opt.name }}</label>
                <div v-for="(option, n)  in opt.options" :key="n">
                    <input type="radio" :name="opt.name" v-model="opt.value" :value="option.id"> {{ option.name }}
                </div>
                <br>
                <template v-if="index == 4 && showAll == false">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2 p-2">
                            <button type="button" class="btn btn-dark w-100 font-weight-bold mt-2"
                                @click="showAll = true" :disabled="disabledButton.length > 5">Next</button>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2 p-2">
                            <button type="button" class="btn btn-danger w-100 font-weight-bold mt-2"
                                @click='cancel'>Cancel</button>
                        </div>
                    </div>
                </template>
                <template v-if="index == 9">
                    <div class="row">
                        <div class="col-xs-4 col-sm-3 col-md-2 col-lg-1 p-2">
                            <button type="button" class="btn btn-dark w-100 font-weight-bold mt-2"
                                @click='submit' :disabled="disabledButton.length">Submit</button>
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-2 col-lg-1 p-2">
                            <button type="button" class="btn btn-warning w-100 font-weight-bold mt-2"
                                @click='showAll= false'>Back</button>
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-2 col-lg-1 p-2">
                            <button type="button" class="btn btn-danger w-100 font-weight-bold mt-2"
                                @click='cancel'>Cancel</button>
                        </div>
                    </div>
                </template>
            </template>
        </div>
    </div>
</template>
 
<script>
import { mapMutations, mapActions, mapState, mapGetters } from 'vuex'

export default {
    data: () => ({
        loading: false,
        showAll: false,
    }),
    computed: {
        ...mapState('survey', ['questions']),
        ...mapGetters('survey', ['getQuestions']),
        disabledButton() {
            return this.questions.filter((question) => question.value == null)
        },
        surveyQuestions: {
            get() {
                return this.questions
            },
            set(question) {
                return this.questions = question
            }
        }
    },
    methods: {
        ...mapMutations('auth', ['removeAuth']),
        ...mapActions('survey', ['submitSurvey', 'fetchQuestions']),
        submit() {
            this.submitSurvey(this.questions);
            this.$emit('sumited');
        },
        cancel() {
            this.fetchQuestions();
            this.$emit('cancel');
            this.$notify({
                title: 'Survey',
                text: 'Survey canceled',
                type: 'warn',
            });
        }
    },
}
</script>