import {ref} from "vue";
import axios from "axios";

export default function useBuilding() {
    const buildings = ref([]);

    const getBuildings = async () => {
        let response = await axios.get('/api/v1/buildings')
        buildings.value = response.data.data.buildings;
    }

    return {
       buildings,
        getBuildings
    }
}
