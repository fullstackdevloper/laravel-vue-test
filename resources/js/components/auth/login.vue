<template>
    login
</template>
 
<script>
export default {
    data: () => ({
        loading: false,
        authenticated: localStorage.getItem('token'),
        form: {
            email: '',
            password: ''
        },
        showPassword: false,
        emailRules: [
            (v) => !!v || 'E-mail is required',
            (v) => /.+@.+\..+/.test(v) || 'E-mail must be valid',
        ],
        passwordRules: [
            (v) => !!v || 'Password is required',
            (v) => (v && v.length >= 8) || 'password must be greater than 8 characters',
        ]
    }),

    methods: {
        async validate() {
            const { valid } = await this.$refs.form.validate()

            if (valid) alert('Form is valid')
        },
        reset() {
            this.$refs.form.reset()
        },
        resetValidation() {
            this.$refs.form.resetValidation()
        },
        login() {
        }
    },
}
</script>