<!-- resources/views/assets/show.blade.php -->

@if ($assets->isEmpty())
    <p>No assets found.</p>
@else
    <ul>
        @foreach ($assets as $asset)
            <li>{{ $asset->name }} - ${{ $asset->value }}</li>
        @endforeach
    </ul>
@endif
