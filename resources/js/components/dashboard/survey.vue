<template>
    <div class="mb-5">
        <div v-for="(opt, index) in questions" :key="index">
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
                                @click="showAll = true">Next</button>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2 p-2">
                            <button type="button" class="btn btn-danger w-100 font-weight-bold mt-2"
                                @click='cancel'>Cancel</button>
                        </div>
                    </div>
                </template>
                <template v-if="index == 9">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2 p-2">
                            <button type="button" class="btn btn-dark w-100 font-weight-bold mt-2"
                                @click='submit'>Submit</button>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2 p-2">
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
import { mapMutations, mapActions, mapState } from 'vuex'

export default {
    data: () => ({
        loading: false,
        showAll: false,
    }),
    computed: {
        ...mapState('survey', ['questions']),
    },
    methods: {
        ...mapMutations('auth', ['removeAuth']),
        ...mapActions('survey', ['submitSurvey']),
        submit() {
            this.submitSurvey(this.questions);
        }
    },
}
</script>