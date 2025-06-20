@props(["paginator" => []])

@if ($paginator->hasPages())
  <div class="join inline-flex">
    <button
      wire:click="previousPage()"
      class="join-item btn btn-sm"
      @disabled($paginator->onFirstPage())
    >
      «
    </button>
    @php
      $currentPage = $paginator->currentPage();
      $lastPage = $paginator->lastPage();
      $start = max(1, min($currentPage - 2, $lastPage - 4));
      $end = min($lastPage, max(5, $currentPage + 2));
    @endphp

    @foreach (range($start, $end) as $page)
      <button
        wire:click="gotoPage({{ $page }})"
        @class([
          "join-item btn btn-sm",
          "btn-active" => $page == $currentPage,
        ])
        @disabled($page == $currentPage)
      >
        {{ $page }}
      </button>
    @endforeach

    <button
      wire:click="nextPage()"
      class="join-item btn btn-sm"
      @disabled($paginator->onLastPage())
    >
      »
    </button>
  </div>
@endif
