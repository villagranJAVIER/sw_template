<script setup>
import HeadLogo from '@/Components/HeadLogo.vue';
import LayoutWelcome from '@/Layouts/LayoutWelcome.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    title: {
        type: String,
        required: true
    }
});

</script>

<template>
    <HeadLogo :title="title" />
    <LayoutWelcome>
        <section>
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-20 lg:px-8">
                <div class="max-w-2xl lg:max-w-4xl mx-auto text-center">
                    <h2 class="dark:text-blue-200 text-3xl sm:text-4xl font-semibold text-gray-900">Visita nuestras
                        instalaciones</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-3">Lorem ipsum dolor sit amet consectetur adipisicing
                        elit.</p>
                </div>
                <div class="mt-16 lg:mt-20">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="rounded-lg overflow-hidden">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3774.9390356660615!2d-99.14288002406684!3d18.889785557790677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ce7436090d122b%3A0x2acb88c1b5c1452a!2sUniversidad%20Polit%C3%A9cnica%20del%20Estado%20de%20Morelos!5e0!3m2!1ses-419!2smx!4v1740372435728!5m2!1ses-419!2smx"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div>
                            <div class="max-w-full mx-auto rounded-lg overflow-hidden">
                                <div class="px-6 py-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">
                                        Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur,
                                        adipisci velit
                                    </h3>
                                    <p class="text-justify mt-1 text-gray-600 dark:text-gray-400">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ac mollis justo.
                                        Nullam eget lorem viverra, gravida magna sit amet, viverra mi. Aliquam erat
                                        volutpat. Mauris et quam a lectus venenatis malesuada quis a felis. Nulla
                                        facilisi. Aenean convallis eu ante at faucibus. Mauris dignissim mauris ut est
                                        scelerisque, et volutpat neque dapibus. Praesent nec dui condimentum, fermentum
                                        nulla vel, varius quam. Aliquam quis eros nec ligula feugiat suscipit. Quisque
                                        blandit lorem eu hendrerit fringilla. In mollis convallis venenatis. Morbi leo
                                        augue, maximus vel fringilla eu, ornare sed mauris. In vitae nulla vitae ex
                                        ultrices fermentum. Mauris lacinia dolor eget sollicitudin consequat.
                                    </p>
                                </div>
                                <div class="border-t border-gray-400 dark:border-gray-200 px-6 py-4">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-200">Lorem ipsum</h3>
                                    <p class="mt-1 text-gray-600 dark:text-gray-400">Lorem ipsum dolor sit amet,
                                        consectetur adipiscing elit. In ac mollis justo. Nullam eget lorem viverra.</p>
                                </div>

                                <div class="border-t border-gray-400 dark:border-gray-200 px-6 py-4">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-200">Contacto</h3>
                                    <p class="mt-1 text-gray-600 dark:text-gray-400">Email: info@example.com</p>
                                    <p class="mt-1 text-gray-600 dark:text-gray-400">Teléfono: +52 777 362 77 70</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </LayoutWelcome>
</template>