<template>
    <div class="container mx-auto mt-1.5 text-justify p-2 rounded-lg"
        :class="$page.props.app.settingsStyles.main.innerSection">
        <h1 class="text-lg font-bold text-center mb-2 mx-1 bg-gray-400 rounded flex justify-center">
            <slot name="header" />
        </h1>
        <slot name="content" />
    </div>
</template>