<template>
    <div class="bg-gray-100 py-10">
        <div class="mx-auto max-w-7xl">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-xl font-semibold text-gray-900">
                            Kelas PBKK B 2024
                        </h1>
                        <p class="mt-2 text-sm text-gray-700">
                            Jumlah Mahasiswa
                        </p>
                    </div>

                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                        <button
                            @click="openModal('add')"
                            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                        >
                            Tambahkan Mahasiswa
                        </button>
                    </div>
                </div>

                <div class="flex flex-col justify-between sm:flex-row mt-6">
                    <div class="relative text-sm text-gray-800 col-span-3">
                        <div
                            class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500"
                        >
                            <MagnifyingGlass />
                        </div>

                        <input
                            type="text"
                            autocomplete="off"
                            placeholder="Mencari Mahasiswa..."
                            id="search"
                            class="block rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        />
                    </div>
                </div>

                <div class="mt-8 flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div
                            class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                        >
                            <div
                                class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative"
                            >
                                <table
                                    class="min-w-full divide-y divide-gray-300"
                                >
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                            >
                                                ID
                                            </th>
                                            <th
                                                scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                            >
                                                Nama
                                            </th>
                                            <th
                                                scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                            >
                                                Email
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                NRP
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                Dibuat Sejak
                                            </th>
                                            <th
                                                scope="col"
                                                class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                            />
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="divide-y divide-gray-200 bg-white"
                                    >
                                        <tr v-for="mahasiswa in mahasiswas.data" :key="mahasiswa.id">
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                                            >
                                                {{ mahasiswa.id }}
                                            </td>
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                                            >
                                                {{ mahasiswa.nama }}
                                            </td>
                                            <td
                                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                            >
                                                {{ mahasiswa.email }}
                                            </td>
                                            <td
                                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                            >
                                                {{ mahasiswa.nrp }}
                                            </td>
                                            <td
                                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                            >
                                                {{ mahasiswa.created_at }}
                                            </td>

                                            <td
                                                class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                                            >
                                                <button
                                                    @click="openModal('edit', mahasiswa)"
                                                    class="text-indigo-600 hover:text-indigo-900"
                                                >
                                                    Edit
                                                </button>
                                                <button
                                                    @click="deleteMahasiswa(mahasiswa.id)"
                                                    class="ml-2 text-indigo-600 hover:text-indigo-900"
                                                >
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4 flex justify-between">
                                <button
                                    @click="changePage(mahasiswas.prev_page_url)"
                                    :disabled="!mahasiswas.prev_page_url"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded disabled:opacity-50"
                                >
                                    Previous
                                </button>
                                <button
                                    @click="changePage(mahasiswas.next_page_url)"
                                    :disabled="!mahasiswas.next_page_url"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded disabled:opacity-50"
                                >
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="showModal" class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    {{ modalType === 'add' ? 'Add Student' : 'Edit Student' }}
                                </h3>
                                <div class="mt-2">
                                    <form @submit.prevent="submitForm">
                                        <div>
                                            <label for="nama">Nama</label>
                                            <input type="text" v-model="form.nama" id="nama" class="mt-1 block w-full" />
                                        </div>
                                        <div>
                                            <label for="nrp">NRP</label>
                                            <input type="text" v-model="form.nrp" id="nrp" class="mt-1 block w-full" />
                                        </div>
                                        <div>
                                            <label for="email">Email</label>
                                            <input type="email" v-model="form.email" id="email" class="mt-1 block w-full" />
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                {{ modalType === 'add' ? 'Add' : 'Update' }}
                                            </button>
                                            <button @click="closeModal" type="button" class="ml-2 inline-flex justify-center rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import { ref, onMounted } from 'vue';
import $ from 'jquery';

export default {
    components: {
        MagnifyingGlass,
    },
    props: {
        mahasiswas: Object,
        filters: Object,
    },
    setup(props) {
        const showModal = ref(false);
        const modalType = ref('add');
        const form = ref({
            nama: '',
            nrp: '',
            email: '',
        });

        const openModal = (type, mahasiswa = null) => {
            modalType.value = type;
            if (type === 'edit' && mahasiswa) {
                form.value = { ...mahasiswa };
            } else {
                form.value = { nama: '', nrp: '', email: '' };
            }
            showModal.value = true;
        };

        const closeModal = () => {
            showModal.value = false;
        };

        const submitForm = () => {
            if (modalType.value === 'add') {
                Inertia.post('/mahasiswa', form.value);
            } else {
                Inertia.put(`/mahasiswa/${form.value.id}`, form.value);
            }
            closeModal();
        };

        const changePage = (url) => {
            if (url) {
                Inertia.get(url);
            }
        };

        onMounted(() => {
            $('#search').on('input', function() {
                const search = $(this).val();
                Inertia.get('/mahasiswa', { search }, { preserveState: true });
            });
        });

        return {
            showModal,
            modalType,
            form,
            openModal,
            closeModal,
            submitForm,
            changePage,
        };
    },
    methods: {
        deleteMahasiswa(id) {
            if (confirm('Are you sure you want to delete this mahasiswa?')) {
                Inertia.delete(`/mahasiswa/${id}`);
            }
        },
    },
};
</script>