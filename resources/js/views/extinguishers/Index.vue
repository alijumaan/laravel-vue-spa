<template>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div v-if="isAdmin" class="d-flex mb-3">
                <router-link v-if="isAdmin" :to="{ name: 'extinguisherCreate'}"
                             class="ml-auto btn btn-primary btn-sm">
                    <i class="fa fa-plus fa-fw"></i>
                    سحب طفاية من مبنى
                </router-link>
            </div>
            <div class="card shadow">
                <div class="p-3 d-flex">
                    <h4>طفايات تحت الصيانة</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead class="">
                        <tr class="bg-dark text-white">
                            <th>نوع الطفاية</th>
                            <th>عدد</th>
                            <th width="10%">مزيد</th>
                        </tr>
                        </thead>
                        <tbody v-if="extinguishers.length > 0">
                            <tr v-for="extinguisher in extinguishers">
                                <td>{{ extinguisher.extinguisherType }}</td>
                                <td>{{ extinguisher.extinguisherCount }}</td>
                                <td>
                                    <router-link
                                        :to="{ name: 'extinguisherShow', params: { id: extinguisher.id } }">
                                        التفاصيل
                                    </router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p v-show="!extinguishers.length > 0"
                       class="text-center">لاتوجد نتائج .</p>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            extinguishers: [],
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!localStorage.getItem("authToken")) {
            return next({name: 'login'})
        }
        next();
    },
    computed: {
        isAdmin() {
            return this.$store.state.currentUser.isAdmin;
        }
    },
    created() {
        this.$store.dispatch('currentUser/isAdmin');
        this.loadExtinguishers()
    },
    methods: {
        loadExtinguishers() {
            axios.get('/api/v1/extinguishers').then(response => {
                this.extinguishers = response.data.data
            }).catch(err => {
                console.log(err.message)
            })
        },
    }
}
</script>

<style scoped>
a {
    text-decoration: none !important;
}
</style>
