import {ref} from "vue";

export default function useUsers() {

    const users = ref({});

    const loadUsers = () => {
        axios.get('/api/v1/users').then(response => {
            users.value = response.data.users
        })
    }

    return {
        loadUsers,
        users
    }
}
