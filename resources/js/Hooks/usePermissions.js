import { usePage } from "@inertiajs/vue3";

export const useCan = (permission) => !!usePage().props.auth.can[permission];
export const useRoles = (roles) => Object.keys(usePage().props.auth.roles).some(role => Object.values(roles).indexOf(role) > -1);
export const useRole = (role) => !!usePage().props.auth.roles[role];
