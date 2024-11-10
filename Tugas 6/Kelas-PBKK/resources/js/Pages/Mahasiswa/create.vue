<template>
    <div>
        <h1>Create Mahasiswa</h1>
        <form @submit.prevent="submit">
            <div>
                <label for="nama">Nama</label>
                <input type="text" v-model="form.nama" id="nama" />
            </div>
            <div>
                <label for="nrp">NRP</label>
                <input type="text" v-model="form.nrp" id="nrp" />
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" v-model="form.email" id="email" />
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue';

export default {
    setup() {
        const form = ref({
            nama: '',
            nrp: '',
            email: '',
        });

        const submit = () => {
            Inertia.post('/mahasiswa', form.value);
        };

        return { form, submit };
    },
};
</script>