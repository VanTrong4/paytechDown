<div class="card-footer">
  <p>{{ __('ページ:current目/:last、合計:total件の結果:count件',['current'   =>  $items->currentPage(),'last' => $items->lastPage(),'count'    =>  $items->count(), 'total' =>  $items->total() ]) }}</p>
  {{ $items->appends(request()->input())->links('vendor.pagination.default') }}
</div>