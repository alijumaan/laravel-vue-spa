<template>
    <div class="card shadow-sm">
        <div class="card-header d-flex">
            <div class="ml-auto">
                <router-link exact :to="{name: 'contacts', params: { id: message.id }}"
                             class="ml-auto btn btn-primary btn-sm">
                    رجوع
                </router-link>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <tbody>
                <tr>
                    <th>المرسل</th>
                    <td>{{ message.name }}</td>
                </tr>
                <tr>
                    <th>البريد الإلكتروني</th>
                    <td>{{ message.email }}</td>
                </tr>
                <tr>
                    <th>العنوان</th>
                    <td>{{ message.title }}</td>
                </tr>
                <tr>
                    <th>الرسالة</th>
                    <td>{{ message.body }}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            message: {}
        }
    },
    created() {
        this.showMessage();
    },
    methods: {
        showMessage() {
            axios.get(`/api/v1/contacts/${this.$route.params.id}`).then(response => {
                this.message = response.data.data
            })
        },
    }
}
</script>

<style scoped></style>
