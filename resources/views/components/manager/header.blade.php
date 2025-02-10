<header id="page-header" class="z-1 flex flex-none items-center">
    <div class="container mx-auto px-4 lg:px-8 xl:max-w-7xl">
      <div
        class="flex justify-between border-b-2 border-slate-200/50 py-6"
      >
        <!-- Left Section -->
        <div class="flex items-center">
          <!-- Logo -->
            <x-manager.header-logo :book="$book" />
          <!-- END Logo -->
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="flex items-center gap-1 lg:gap-5">
          <!-- Header Navigation -->
           <!--<x-manager.header-navigation /> -->
          <!-- END Header Navigation -->

          <!-- User Dropdown -->
          <x-manager.user-dropdown />
          <!-- END User Dropdown -->

          <!-- Toggle Mobile Navigation -->
         <x-manager.toggle-mobile-navigation />
          <!-- END Toggle Mobile Navigation -->
        </div>
        <!-- END Right Section -->
      </div>

      <!-- Mobile Navigation -->
      <x-manager.mobile-navigation />
      <!-- END Mobile Navigation -->
    </div>
</header>
