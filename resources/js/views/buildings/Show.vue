<template>
    <div>
        <div class="card shadow">
            <div class="card-header d-flex">
                <h5>
                    <span :class="building.checked_at > now ? 'badge badge-success' : 'badge badge-danger'">
                        مبنى {{ building.name }}
                    </span>

                    ({{ building.number }})

                    <span :class="building.checked_at > now ? 'text-success' : 'text-danger'">
                        {{ building.statusText }}
                    </span>
                </h5>
                <router-link exact :to="{name: 'buildings', params: { id: building.slug }}"
                             class="ml-auto btn btn-primary btn-sm">
                    رجوع
                </router-link>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless table-sm">
                    <thead class="table-dark">
                    <tr>
                        <th>المفتش</th>
                        <th>تاريخ التشييك</th>
                        <th>تاريخ الإنتهاء</th>
                        <th>ملاحظات</th>
                        <th width="25%">إجراءات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ building.user }}</td>
                        <td><span class="badge badge-success">{{ building.updated_at }}</span></td>
                        <td><span :class="building.checked_at > now ? 'badge badge-success' : 'badge badge-danger'">{{ building.checked_at }}</span></td>
                        <td>{{ building.notes }}</td>
                        <td>
                            <a class="btn btn-sm" data-toggle="modal" data-target="#updateBuilding">
                                <i class="fa fa-edit text-primary mr-1"></i>
                            </a>
                            <router-link
                                v-if="isAdmin"
                                :to="{ name: 'buildings.edit', params: { id: building.slug } }">
                                <i class="fas fa-wrench text-primary"></i>
                            </router-link>
                            <button
                                v-if="isAdmin"
                                @click="delete_building(building.slug)"
                                class="trash">
                                <i class="fa fa-trash text-danger"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- modal form start -->
        <div id="updateBuilding" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white">تحديث المبنى</h5>
                    </div>
                    <div class="modal-body">
                        <div class="card-body p-3">
                            <form @submit.prevent="update_building">
                                <!-- status -->
                                <div class="form-group">
                                    <label for="status">الحالة</label>
                                    <select v-model="building.status" id="status" class="form-control">
                                        <option value="">-- اختر حالة الصلاحية --</option>
                                        <option value="0">منتهي</option>
                                        <option value="1">مشيك</option>
                                    </select>
                                    <div v-if="errors && errors.status">
                                        <div v-for="error in errors.status"
                                             class="text-danger" role="alert">
                                            <p>{{ error }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- period_id -->
                                <div class="form-group">
                                    <label for="period_id">فترة صلاحية الفحص</label>
                                    <select v-model="building.period_id" id="period_id" class="form-control">
                                        <option value="">-- اختر فترة الصلاحية --</option>
                                        <option v-for="period in periods" :value="period.id">
                                            {{ period.period }}
                                        </option>
                                    </select>
                                    <div v-if="errors && errors.period_id">
                                        <div v-for="error in errors.period_id"
                                             class="text-danger" role="alert">
                                            <p>{{ error }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- notes -->
                                <div class="form-group">
                                    <label for="notes">ملاحظات</label>
                                    <input v-model="building.notes" type="text" id="notes" class="form-control">

                                    <div v-if="errors && errors.notes">
                                        <div v-for="error in errors.notes"
                                             class="text-danger" role="alert">
                                            <p>{{ error }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                            :class="form_submitting ? 'btn btn-secondary' : 'btn btn-primary'"
                                            v-text="form_submitting ? 'جار التحديث...' : 'تحديث المبنى'"
                                            :disabled="form_submitting"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="close" type="button" class="btn btn-danger" data-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal form ended -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            now: new Date().toISOString(),
            building: {},
            periods: {},
            errors: [],
            fields: {
                "status": "",
                "notes": "",
                "period_id": ""
            },
            form_submitting: false
        }
    },
    computed: {
        isAdmin() {
            return this.$store.state.currentUser.isAdmin;
        }
    },
    created() {
        this.$store.dispatch('currentUser/isAdmin');
        this.showBuilding();
        this.loadPeriod()
    },
    methods: {
        showBuilding() {
            axios.get(`/api/v1/buildings/${this.$route.params.id}`).then(response => {
                this.building = response.data.building
            }).catch(error => {
                console.log('Error show the building')
            })
        },
        loadPeriod() {
            axios.get('/api/v1/periods').then(response => {
                this.periods = response.data.periods;
            })
        },
        update_building() {
            this.form_submitting = true;
            axios.put(`/api/v1/buildings/${this.building.slug}/quickUpdate`, {
                status: this.building.status,
                period_id: this.building.period_id,
                notes: this.building.notes
            }).then(response => {
                toast.fire({
                    icon: 'success',
                    title: 'تم تحديث المبنى بنجاح'
                })
                // this.$router.push(`/buildings`);
                location.replace('/buildings')
                this.form_submitting = false;
            }).catch(error => {
                this.errors = error.response.data.errors;
                this.form_submitting = false;
            })
        },
        delete_building(building) {
            swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من التراجع عن هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'تأكيد الحذف'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/v1/buildings/' + building).then(response => {
                        this.$router.push('/buildings');
                    })
                    toast.fire({
                        icon: 'success',
                        title: 'تم حذف المبنى نجاح'
                    })
                }
            })

        }
    }
}
</script>

<style scoped>
.trash {
    border: none;
    color: #FF0000;
    outline: none;
    margin-left: 5px;
    background: white;
}
</style>
