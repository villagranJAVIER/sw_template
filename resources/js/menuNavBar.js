import {
    mdiMenu,
    mdiClockOutline,
    mdiCloud,
    mdiCrop,
    mdiAccount,
    mdiCogOutline,
    mdiEmail,
    mdiLogout,
    mdiThemeLightDark,
    mdiGithub,
    mdiReact,
} from "@mdi/js";

export default [
    {
        icon: mdiAccount,
        isRol: true,
    },
    {
        isCurrentUser: true,
        menu: [
            {
                icon: mdiAccount,
                label: "Mi perfil",
                href: "/profile",
            },
            // {
            //   icon: mdiCogOutline,
            //   label: "Settings",
            // },
            {
                icon: mdiEmail,
                label: "Notificaciones",
            },
            {
                isDivider: true,
            },
        ],
    },
    {
        icon: mdiThemeLightDark,
        label: "Light/Dark",
        isDesktopNoLabel: true,
        isToggleLightDark: true,
    },
    {
        icon: mdiLogout,
        bg: "text-red-600",
        isLogout: true,
    },
];
