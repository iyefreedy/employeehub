<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue'

const dt = ref(null)

defineProps({
    employees: {
        type: Array
    }
})

</script>

<template>
    <Head title="Employees" />
    <AuthenticatedLayout>
        <div class="grid">
            <div class="col-12">
                <div class="card">
                    <Toast />
                    <Toolbar class="mb-4">
                        <template v-slot:start>
                            <div class="my-2">
                                <Button label="New" icon="pi pi-plus" class="p-button-success mr-2" @click="openNew" />
                                <Button label="Delete" icon="pi pi-trash" class="p-button-danger"
                                    @click="confirmDeleteSelected"
                                    :disabled="!selectedProducts || !selectedProducts.length" />
                            </div>
                        </template>

                        <template v-slot:end>
                            <FileUpload mode="basic" accept="image/*" :maxFileSize="1000000" label="Import"
                                chooseLabel="Import" class="mr-2 inline-block" />
                            <Button label="Export" icon="pi pi-upload" class="p-button-help" @click="exportCSV($event)" />
                        </template>
                    </Toolbar>

                    <DataTable ref="dt" :value="employees" :paginator="true" :rows="10"
                        paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown">
                        <Column field="name" header="Name" :sortable="true" headerStyle="width:14%; min-width:10rem;">
                            <template #body="slotProps">
                                <span class="p-column-title">Name</span>
                                {{ slotProps.data.name }}
                            </template>
                        </Column>
                        <Column field="gender" header="Gender" headerStyle="width:14%; min-width:10rem;">
                            <template #body="slotProps">
                                <span class="p-column-title">Gender</span>
                                {{ slotProps.data.gender }}
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
