@props(["paginator" => []])

<nav
  class="flex-column flex flex-wrap items-center justify-center md:flex-row md:justify-between"
  aria-label="Table navigation"
>
  <x-pagination.info :paginator="$paginator" />
  <x-pagination :paginator="$paginator" />
</nav>
