<template>
    <div class="bg-white p-5">
        <h4>{{ $t('titles.edit_my_information') }}</h4>
        <form @submit.prevent="updateProfile" enctype="multipart/form-data">
            <div class="row mt-5">

                <div class="col-lg-4 text-center mb-5" v-if="user">
                    <img id="avatar_img" @mouseover="chooseFile"
                         :src="user.avatar" class="profile"
                         alt="avatar">
                    <input type="file" @change="selectFile" id="avatar_file" class="d-none">
                    <div v-if="errors">
                        <span v-for="error in errors.avatar" class="text-danger" role="alert">
                            {{ error }}
                        </span>
                    </div>
                </div>

                <div class="col-lg-8">
                    <form @submit.prevent="updateProfile" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-lg-3">{{ $t('fields.username') }}</label>
                            <div class="col-lg-9">
                                <p>{{ user.username }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3">{{ $t('fields.name')}}</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" v-model="user.name">
                                <div v-if="errors">
                                <span v-for="error in errors.name" class="text-danger" role="alert">
                                    {{ error }}
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3" id="email">{{ $t('fields.email')}}</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="email" v-model="user.email">

                                <div v-if="errors">
                                    <span v-for="error in errors.email" class="text-danger" role="alert">
                                        {{ error }}
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3">{{ $t('fields.bio')}}</label>
                            <div class="col-lg-9" v-if="user">
                                <textarea class="form-control" rows="5" name="bio" v-model="user.bio"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-9">
                                <input type="submit" class="btn btn-primary" :value="$t('buttons.save')">
                                <input type="reset" class="btn btn-secondary mr-1" :value="$t('actions.cancel')">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            errors: [],
            fields: {
                avatar: null
            }
        }
    },
    computed: {
        user() {
            return this.$store.state.currentUser.user;
        }
    },
    methods: {
        chooseFile() {
            $('#avatar_img').click(function () {
                $("input[id='avatar_file']").click();
            })
            $("#avatar_file").change(function () {
                let reader = new FileReader();
                reader.onload = function () {
                    $("#avatar_img").addClass("avatar_preview").attr("src", reader.result);
                }
                reader.readAsDataURL(event.target.files[0]);
            })
        },

        selectFile(event) {
            this.fields.avatar = event.target.files[0];
        },

        updateProfile() {
            axios.post('/api/v1/user/update/profile', {
                name: this.user.name,
                email: this.user.email,
                bio: this.user.bio
            }).then(() => {
                toast.fire({
                    icon: 'success',
                    title: this.$i18n.t('messages.updated_successfully')
                })
            }).catch(error => {
                this.errors = error.response.data.errors;
            })

            if (this.fields.avatar) {
                let fields = new FormData();
                for (let key in this.fields) {
                    fields.append(key, this.fields[key]);
                }
                axios.post('/api/v1/user/update/avatar', fields).then(() => {
                    location.reload();
                    toast.fire({
                        icon: 'success',
                        title: this.$i18n.t('messages.updated_successfully')
                    })
                }).catch(error => {
                    this.errors = error.response.data.errors;
                })
            }
        },

    }
}


</script>

<style scoped>

</style>
