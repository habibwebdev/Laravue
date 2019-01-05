<form action="{{ route('search') }}" method="GET" class="search-form m-0">
    <div class="form-group m-0">

    <input name="query" id="query" class="search-box form-control relative pl-30" type="text" placeholder="Search for product" value="{{ request()->input('query') }}">
        <i class="fas fa-search search-icon"></i>
    </div>
</form>
