<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="Jn9qO7KAKYgYq2CpSGuObIZpaffcK1PovXElqVO9">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <link rel="preload" as="style" href="http://127.0.0.1:8000/build/assets/app-BBRIPhML.css" /><link rel="modulepreload" href="http://127.0.0.1:8000/build/assets/app-CEsE5a7F.js" /><link rel="stylesheet" href="http://127.0.0.1:8000/build/assets/app-BBRIPhML.css" data-navigate-track="reload" /><script type="module" src="http://127.0.0.1:8000/build/assets/app-CEsE5a7F.js" data-navigate-track="reload"></script>
<script>
     window.addEventListener('load', () => window.setTimeout(() => {
        const makeLink = (asset) => {
            const link = document.createElement('link')

            Object.keys(asset).forEach((attribute) => {
                link.setAttribute(attribute, asset[attribute])
            })

            return link
        }

        const loadNext = (assets, count) => window.setTimeout(() => {
            if (count > assets.length) {
                count = assets.length

                if (count === 0) {
                    return
                }
            }

            const fragment = new DocumentFragment

            while (count > 0) {
                const link = makeLink(assets.shift())
                fragment.append(link)
                count--

                if (assets.length) {
                    link.onload = () => loadNext(assets, 1)
                    link.error = () => loadNext(assets, 1)
                }
            }

            document.head.append(fragment)
        })

        loadNext([], 3)
    }))
</script>
        <!-- Styles -->
        <!-- Livewire Styles --><style >[wire\:loading][wire\:loading], [wire\:loading\.delay][wire\:loading\.delay], [wire\:loading\.inline-block][wire\:loading\.inline-block], [wire\:loading\.inline][wire\:loading\.inline], [wire\:loading\.block][wire\:loading\.block], [wire\:loading\.flex][wire\:loading\.flex], [wire\:loading\.table][wire\:loading\.table], [wire\:loading\.grid][wire\:loading\.grid], [wire\:loading\.inline-flex][wire\:loading\.inline-flex] {display: none;}[wire\:loading\.delay\.none][wire\:loading\.delay\.none], [wire\:loading\.delay\.shortest][wire\:loading\.delay\.shortest], [wire\:loading\.delay\.shorter][wire\:loading\.delay\.shorter], [wire\:loading\.delay\.short][wire\:loading\.delay\.short], [wire\:loading\.delay\.default][wire\:loading\.delay\.default], [wire\:loading\.delay\.long][wire\:loading\.delay\.long], [wire\:loading\.delay\.longer][wire\:loading\.delay\.longer], [wire\:loading\.delay\.longest][wire\:loading\.delay\.longest] {display: none;}[wire\:offline][wire\:offline] {display: none;}[wire\:dirty]:not(textarea):not(input):not(select) {display: none;}:root {--livewire-progress-bar-color: #2299dd;}[x-cloak] {display: none !important;}</style>
    </head>
    <body>
    <form method="POST" action="http://127.0.0.1:8000/register">

        <div class="font-sans text-gray-900 antialiased">
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        <a href="/">
    <svg class="w-16 h-16" viewbox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z" fill="#6875F5"/>
        <path d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z" fill="#6875F5"/>
    </svg>
</a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <form method="POST" action="http://127.0.0.1:8000/register">
            <input type="hidden" name="_token" value="Jn9qO7KAKYgYq2CpSGuObIZpaffcK1PovXElqVO9" autocomplete="off">
            <div>
                <label class="block font-medium text-sm text-gray-700" for="name">
    Name
</label>
                <input  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="name" type="text" name="name" required="required" autofocus="autofocus" autocomplete="name">
            </div>

            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700" for="email">
    Email
</label>
                <input  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="email" type="email" name="email" required="required" autocomplete="username">
            </div>

            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700" for="password">
    Password
</label>
                <input  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="password" type="password" name="password" required="required" autocomplete="new-password">
            </div>

            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700" for="password_confirmation">
    Confirm Password
</label>
                <input  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="password_confirmation" type="password" name="password_confirmation" required="required" autocomplete="new-password">
            </div>

            
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="http://127.0.0.1:8000/login">
                    Already registered?
                </a>

                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150 ms-4">
    Register
</button>
            </div>
        </form>
    </div>
</div>
        </div>

        <!-- Livewire Scripts -->
<script src="/livewire/livewire.js?id=cc800bf4"   data-csrf="Jn9qO7KAKYgYq2CpSGuObIZpaffcK1PovXElqVO9" data-update-uri="/livewire/update" data-navigate-once="true"></script>
    </body>
</html>
