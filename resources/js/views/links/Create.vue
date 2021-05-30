<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h5>
                        <span class="">انشاء رابط جديد</span>
                    </h5>
                    <router-link exact :to="{ name: 'links' }" class="ml-auto btn btn-danger btn-sm">
                        إلغاء
                    </router-link>
                </div>

                <div class="card-body">
                    <form @submit.prevent="create_link">
                        <div class="form-group">
                            <label for="name">اسم الرابط</label>
                            <input v-model="fields.name" type="text" id="name" class="form-control" placeholder="مثال: الرئيسية">
                            <div v-if="errors && errors.name">
                                <div v-for="error in errors.name"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="number">Url</label>
                            <input v-model="fields.to" type="text" id="number" class="form-control" placeholder="مثال: home/">
                            <div v-if="errors && errors.to">
                                <div v-for="error in errors.to"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="icon">الأيقونة</label>
                            <input v-model="fields.icon" type="text" id="icon" class="form-control" placeholder="مثال: home">
                            <div v-if="errors && errors.icon">
                                <div v-for="error in errors.icon"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="userId">امكانية الظهور</label>
                            <select v-model="fields.access" id="userId" class="form-control">
                                <option value="">-- حدد امكانية الظهور --</option>
                                <option value="1">اظهار</option>
                                <option value="0">اخفاء</option>
                            </select>
                            <div v-if="errors && errors.access">
                                <div v-for="error in errors.access"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary">انشاء</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            fields: {
                "name": "",
                "to": "",
                "icon": "",
                "access": ""
            },
            errors: {},
        }
    },
    methods: {
        create_link() {
            axios.post("/api/v1/links", this.fields).then( () => {
                toast.fire({
                    icon: 'success',
                    title: 'تم الإنشاء بنجاح'
                })
                this.$router.push('/links');
            }).catch(error => {
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>

<style scoped>

</style>
