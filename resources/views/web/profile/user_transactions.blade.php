@forelse ($user->transactionsDescOrder as $transaction)
    <div class="user-book">
        <img src="{{ $transaction->purchasable->getImageURL() ?? '#' }}" class="book-img me-3" alt="Book">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="heading">
                <h5 class="mb-1">
                    @if (strtolower(basename(str_replace('\\', '/', $transaction->purchasable_type))) == 'book')
                        <a href="{{ route('books.show', $transaction->purchasable_id) }}"
                            class="text-dark">{{ $transaction->purchasable->title ?? '-' }}</a>
                    @else
                        {{ $transaction->purchasable->title ?? '-' }}
                    @endif
                </h5>
                <p class="mb-1 date">{{ \Carbon\Carbon::parse($transaction->created_at)->format('F d, Y') }}
                </p>
                <div class="d-flex"><b>TID:</b>
                    <pre> {{ $transaction->transaction_id }}</pre>
                </div>

            </div>
            <div class="d-flex flex-column justify-content-center">
                <div class="d-flex mb-0 text-{{ $transaction->status == 'pending' ? 'warning' : ($transaction->status == 'completed' ? 'success' : 'danger') }}"
                    title="{{ $transaction->status }}">
                    <iconify-icon icon="bi:currency-rupee" class="me-0 pt-2"></iconify-icon>
                    <span class="fs-5">{{ round($transaction->amount, 2) }}</span>
                </div>
                @if ($transaction->status != 'completed')
                    <small class="text-{{ $transaction->status == 'pending' ? 'warning' : ($transaction->status == 'completed' ? 'success' : 'danger') }}">{{ ucfirst($transaction->status) }}</small>
                @endif
            </div>
        </div>
    </div>

@empty
    <x-no-data icon="solar:wallet-money-bold-duotone" text="No Transactions Yet" />
@endforelse
