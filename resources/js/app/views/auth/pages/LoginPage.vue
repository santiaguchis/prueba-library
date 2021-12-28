<template>
    <v-container fluid>
        <v-form

            @submit.prevent="loader='loading'; onLogin()"
            ref="form"
            v-model="formValid"
            lazy-validation
            class="py-2 "
            >
            <img src="/imgs/logo.png" alt="Logo" class="logo mb-5">
            <div class="form-box">
                <div class="text-h5 mb-2 white--text text-center">¡Bienvenido!</div>
                <div class="text-body-1 white--text text-center">Inicia sesión para ingresar al sistema</div>
                <div class="form-input">
                    <v-text-field
                        outlined
                        dark
                        type="text"
                        v-model="email"
                        label="Correo"
                        required
                        >
                        <v-icon
                            slot="append"
                        >
                            mdi-shield-account
                        </v-icon>
                    </v-text-field>
                    <v-text-field
                        dark
                        outlined
                        v-model="password"
                        label="Contraseña"
                        required
                        :append-icon="value ? 'mdi-eye' : 'mdi-eye-off'"
                        @click:append="() => ( value =! value )"
                        :type="value ? 'password' : 'text'"
                    >
                    </v-text-field>
                </div>
                <div class="buttons">
                    <v-btn

                        type="submit"
                        class="text-button"
                        color="secondary"
                        :loading="loading"
                        :disabled="!formValid"
                        >
                        Iniciar sesión
                    </v-btn>
                </div>
            </div>
        </v-form>
         <v-snackbar
            v-model="errors.show"
            >
                {{ errors.msg }}
                <template v-slot:action="{ attrs }">
                    <v-btn
                        color="red"
                        text
                        v-bind="attrs"
                        @click="errors.show = false"
                        >
                        Cerrar
                        </v-btn>
                </template>
            </v-snackbar>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {
                page : {
                    error : false,
                },
                errors : {
                    show : false,
                    msg : ''
                },
                value: String,
                formValid: true,
                rulesForm: {
                    emailRules: [
                        v => !!v || 'Correo es requerido'
                    ],
                    passwordRules: [
                        v => !!v || 'Contraseña es requerida',
                    ]
                },
                email: '',
                password: '',
                loading: false,
                loader: null,
            }
        },
        watch: {
            loader () {
                const l = this.loader
                this[l] = !this[l]

                setTimeout( () => ( this[l] = false ), 2500)

                this.loader = null
            },
        },
        methods: {
            validate () {
                this.$refs.form.validate()
            },
            reset () {
                this.$refs.form.reset()
            },
            resetValidation () {
                this.$refs.form.resetValidation()
            },
            onLogin () {
                if ( this.formValid ) {
                    let data = {
                        username: this.email,
                        password: this.password,
                    }
                    this.$store.dispatch( 'Auth/login' , data )
                        .then( async( response ) => {
                            if( response.status ) {
                                this.$toast.success( response.message.description , response.message.title )
                                this.$router.push({ name: 'home' })
                            } else {
                                this.$toast.warning( response.message.description , response.message.title )
                            }
                            return false
                        })
                } else {
                    this.$refs.form.validate()
                }
            }
        },
        mounted() {
            this.validate();
        }
    }
</script>

<style lang="scss" scoped>
form {
    width: 100%;
    max-width: 360px;
    margin: auto;
    img.logo {
        max-width: 220px;
        width: 40%;
        display: block;
        margin: 24px auto 0;
    }
    .form-box {
        padding: 0 16px 16px;
    }
    .buttons {
        text-align: center;
        margin-top: 6px;
    }
    h2 {
        font-size: 20px;
        margin: auto;
        text-align: center;
        color: white;
        font-weight: 300;
    }
    h3, h4 {
        text-align: center;
        color: white;
        font-weight: 400;
        margin: 0;
    }
    h3 {
        font-size: 18px;
    }
    h4 {
        font-size: 14px;
        margin: 8px 0;
    }
    .btn-login {
        width: 70%;
        text-transform: uppercase;
    }
    .form-input {
        margin-top: 20px;
        .v-input {
            margin-top: 5px;
        }
    }
    .reminder {
        color: #2196F3;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
        display: inline-block;
        margin-top: 16px;
        &:hover {
            text-decoration: underline;
        }
    }
}
.copyright {
    text-align: center;
    img.by {
        max-width: 120px;
        width: 50%;
        display: block;
        margin: 36px auto 0;
    }
}
input:-webkit-autofill {
    border: 3px solid blue;
}
input:-internal-autofill-selected {
    background: transparent !important;
}
</style>
