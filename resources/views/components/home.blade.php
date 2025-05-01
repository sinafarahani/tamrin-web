<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text[#E0E0Ea] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
<div class="bg-[#ffc5ee] dark:bg-emerald-950 relative lg:mb-0 rounded w-[250px] shrink-0 overflow-hidden">
    <div class="flex aspect-square items-center justify-center rounded-md text-accent-foreground">
        <x-ATU></x-ATU>
    </div>
</div>
<flux:header dir="rtl" container class="border border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900 w-full mt-4">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

    <flux:navbar class="-mb-px max-lg:hidden">
        @auth
            <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                {{ __('داشبورد') }}
            </flux:navbar.item>
        @else
            <flux:navbar.item :href="route('login')" :current="request()->routeIs('login')" wire:navigate>
                {{ __('ورود') }}
            </flux:navbar.item>
            <flux:navbar.item :href="route('register')" :current="request()->routeIs('register')" wire:navigate>
                {{ __('ثبت نام') }}
            </flux:navbar.item>
        @endauth
        <flux:navbar.item :href="route('aboutUs')" :current="request()->routeIs('aboutUs')" wire:navigate>
            {{ __('درباره دانشکده') }}
        </flux:navbar.item>
        <flux:navbar.item :href="route('EducationalGroups')" :current="request()->routeIs('EducationalGroups')" wire:navigate>
            {{ __('گروه های آموزشی') }}
        </flux:navbar.item>
        <flux:navbar.item :href="route('FacultyMembers')" :current="request()->routeIs('FacultyMembers')" wire:navigate>
            {{ __('اعضای هیئت علمی') }}
        </flux:navbar.item>
    </flux:navbar>

    <flux:spacer />

    <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0!">
        <flux:tooltip :content="__('جستوجو')" position="bottom">
            <flux:navbar.item class="!h-10 [&>div>svg]:size-5" icon="magnifying-glass" href="#" :label="__('Search')" />
        </flux:tooltip>
    </flux:navbar>
</flux:header>

<!-- Mobile Menu -->
<flux:sidebar stashable sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
    <flux:spacer />
</flux:sidebar>
<div class="flex flex-row w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
    <div dir="rtl" class="flex w-full flex-col-reverse lg:flex-row dark:bg-neutral-800 bg-neutral-200">
        <flux:main>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-items-center gap-12 h-full w-full dark:text-white text-right">
                {{ $slot }}
            </div>
        </flux:main>
    </div>

    <flux:sidebar sticky stashable class="border-b border-r border-l border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
        <flux:navlist variant="outline">

            <div class="lg:hidden mb-2">
                <flux:navlist.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('داشبورد') }}
                </flux:navlist.item>
                <flux:navlist.item :href="route('aboutUs')" :current="request()->routeIs('aboutUs')" wire:navigate>
                    {{ __('درباره دانشکده') }}
                </flux:navlist.item>
                <flux:navlist.item :href="route('EducationalGroups')" :current="request()->routeIs('EducationalGroups')" wire:navigate>
                    {{ __('گروه های آموزشی') }}
                </flux:navlist.item>
                <flux:navlist.item :href="route('FacultyMembers')" :current="request()->routeIs('FacultyMembers')" wire:navigate>
                    {{ __('اعضای هیئت علمی') }}
                </flux:navlist.item>
            </div>

            <flux:navlist.group class="grid">
                <flux:navlist.item :href="route('EducationalLevels')" :current="request()->routeIs('EducationalLevels')" wire:navigate><div class="lg:text-right">{{ __('مقاطع تحصیلی') }}</div></flux:navlist.item>
            </flux:navlist.group>
            <flux:navlist.group class="grid">
                <flux:navlist.item :href="route('contactUs')" :current="request()->routeIs('contactUs')" wire:navigate><div class="lg:text-right">{{ __('تماس با دانشکده') }}</div></flux:navlist.item>
            </flux:navlist.group>
            <flux:navlist.group class="grid">
                <flux:navlist.item :href="route('PictureAlbum')" :current="request()->routeIs('PictureAlbum')" wire:navigate><div class="lg:text-right">{{ __('آلبوم تصاویر') }}</div></flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />
        @auth()
            <!-- Desktop User Menu -->
            <flux:dropdown dir="rtl" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('تنظیمات') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('خروج') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        @endauth
    </flux:sidebar>

</div>

<flux:footer dir="rtl" class="dark:bg-neutral-900 w-full dark:text-white flex flex-col lg:flex-row justify-around">
    <div>{{__('آدرس: تهران منطقه 22، اولین بیابان دست راست')}}</div>
    <div class="flex flex-col gap-4">{{__('لینک های مرتبط')}}
        <a href="https://www.sanjesh.org/">{{__('سازمان سنجش')}}</a>
    </div>
</flux:footer>

<div class="h-14.5 hidden lg:block"></div>
@fluxScripts
</body>
</html>
