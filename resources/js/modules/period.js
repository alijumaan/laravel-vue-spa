import {ref} from "vue";

export default function usePeriods() {

    const periods = ref({});

    const loadPeriods = () => {
        axios.get('/api/v1/periods').then(response => {
            periods.value = response.data.periods;
        })
    }

    return {
        loadPeriods,
        periods
    }
}
