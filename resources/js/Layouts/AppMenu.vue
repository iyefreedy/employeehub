<script setup>
import { ref } from "vue";

import AppMenuItem from "./AppMenuItem.vue";

const model = ref([
    {
        label: "Home",
        items: [
            { label: "Dashboard", icon: "pi pi-fw pi-home", to: "/dashboard" },
        ],
    },
    {
        label: "Employee Management",
        items: [
            {
                label: "Employee List",
                icon: "pi pi-fw pi-users",
                to: "/employees",
            },
            {
                label: "My Profile",
                icon: "pi pi-fw pi-user",
                to: "/employees/09",
            },
        ],
    },
]);
</script>

<template>
    <ul class="layout-menu">
        <template v-for="(item, i) in model" :key="item">
            <AppMenuItem
                v-if="!item.separator"
                :item="item"
                :index="i"
            />
            <li v-if="item.separator" class="menu-separator"></li>
        </template>
    </ul>
</template>

<style lang="scss" scoped></style>
