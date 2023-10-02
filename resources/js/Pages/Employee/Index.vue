<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import { FilterMatchMode } from "primevue/api";

const dt = ref(null);
const filters = ref({
    nip: { value: null, matchMode: FilterMatchMode.CONTAINS },
    name: { value: null, matchMode: FilterMatchMode.CONTAINS },
    gender: { value: null, matchMode: FilterMatchMode.EQUALS },
    employee_status_id: { value: null, matchMode: FilterMatchMode.EQUALS },
});

const genders = ref([
    { value: "MALE", label: "Laki-Laki" },
    { value: "FEMALE", label: "Perempuan" },
]);

const employeeStatuses = ref([
    { value: 0, label: "intern" },
    { value: 1, label: "permanet" },
    { value: 2, label: "probation" },
    { value: 3, label: "contract" },
    { value: 4, label: "student" },
]);

const employees = ref([]);

onMounted(async () => {
    const response = await window.axios.get("/demo/employee.json");

    employees.value = [...response.data.employees];
});

const getSeverity = (status) => {
    switch (status) {
        case 0:
            return "danger";

        case 1:
            return "success";

        case 2:
            return "info";

        case 3:
            return "warning";

        case 4:
            return null;
    }
};
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
                                <Button
                                    label="New"
                                    icon="pi pi-plus"
                                    class="p-button-success mr-2"
                                />
                                <Button
                                    label="Delete"
                                    icon="pi pi-trash"
                                    class="p-button-danger"
                                />
                            </div>
                        </template>

                        <template v-slot:end>
                            <FileUpload
                                mode="basic"
                                accept="image/*"
                                :maxFileSize="1000000"
                                label="Import"
                                chooseLabel="Import"
                                class="mr-2 inline-block"
                            />
                            <Button
                                label="Export"
                                icon="pi pi-upload"
                                class="p-button-help"
                                @click="exportCSV($event)"
                            />
                        </template>
                    </Toolbar>

                    <DataTable
                        ref="dt"
                        :value="employees"
                        data-key="id"
                        :paginator="true"
                        :rows="10"
                        paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                        v-model:filters="filters"
                        filter-display="row"
                        :global-filter-fields="['name']"
                    >
                        <template #empty> No employees found. </template>
                        <template #loading>
                            Loading employees data. Please wait.
                        </template>
                        <Column
                            field="nip"
                            header="NIP"
                            :sortable="true"
                            headerStyle="width:20%; min-width:10rem;"
                            :filter-match-mode="FilterMatchMode.CONTAINS"
                            :show-filter-menu="false"
                        >
                            <template #body="{ data }">
                                <span class="p-column-title">NIP</span>
                                {{ data.nip }}
                            </template>

                            <template #filter="{ filterModel, filterCallback }">
                                <InputText
                                    v-model="filterModel.value"
                                    type="text"
                                    @input="filterCallback()"
                                    class="p-column-filter"
                                    placeholder="Search by name"
                                />
                            </template>
                        </Column>
                        <Column
                            field="name"
                            header="Name"
                            :sortable="true"
                            headerStyle="width:25%; min-width:10rem;"
                            :filter-match-mode="FilterMatchMode.CONTAINS"
                            :show-filter-menu="false"
                        >
                            <template #body="{ data }">
                                <span class="p-column-title">Name</span>
                                {{ data.name }}
                            </template>

                            <template #filter="{ filterModel, filterCallback }">
                                <InputText
                                    v-model="filterModel.value"
                                    type="text"
                                    @input="filterCallback()"
                                    class="p-column-filter"
                                    placeholder="Search by name"
                                />
                            </template>
                        </Column>
                        <Column
                            field="gender"
                            header="Gender"
                            headerStyle="width:14%; min-width:10rem;"
                            :show-filter-menu="false"
                        >
                            <template #body="{ data }">
                                <span class="p-column-title">Gender</span>
                                {{
                                    data.gender === "male"
                                        ? "Laki-Laki"
                                        : "Perempuan"
                                }}
                            </template>

                            <template #filter="{ filterModel, filterCallback }">
                                <Dropdown
                                    v-model="filterModel.value"
                                    @change="filterCallback"
                                    :options="genders"
                                    placeholder="Select one"
                                    option-label="label"
                                    option-value="value"
                                >
                                    <template #option="{ option }">
                                        <span>{{ option.label }}</span>
                                    </template>
                                </Dropdown>
                            </template>
                        </Column>

                        <Column
                            field="employee_status_id"
                            header="Status"
                            headerStyle="width:14%; min-width:10rem;"
                            :show-filter-menu="false"
                            :filterMenuStyle="{ width: '14rem' }"
                            style="min-width: 12rem"
                        >
                            <template #body="{ data }">
                                <Tag
                                    :value="
                                        employeeStatuses[
                                            data.employee_status_id
                                        ].label
                                    "
                                    :severity="
                                        getSeverity(data.employee_status_id)
                                    "
                                />
                            </template>

                            <template #filter="{ filterModel, filterCallback }">
                                <Dropdown
                                    v-model="filterModel.value"
                                    @change="filterCallback"
                                    :options="employeeStatuses"
                                    placeholder="Select one"
                                    option-label="label"
                                    option-value="value"
                                >
                                    <template #option="{ option }">
                                        <Tag
                                            :value="option.label"
                                            :severity="
                                                getSeverity(option.value)
                                            "
                                        />
                                    </template>
                                </Dropdown>
                            </template>
                        </Column>

                        <Column headerStyle="min-width:10rem;">
                            <template #body>
                                <Button
                                    icon="pi pi-pencil"
                                    class="p-button-rounded p-button-success mr-2"
                                />
                                <Button
                                    icon="pi pi-trash"
                                    class="p-button-rounded p-button-warning mt-2"
                                />
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
