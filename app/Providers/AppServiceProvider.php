<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Place;
use App\Models\ProductStatus;
use App\Models\Unit;
use App\Models\PurchasesHistoryHeader;
use App\Models\PurchasesHistoryDetail;
use App\Models\ChecklistHeader;
use App\Models\ChecklistDetail;
use App\Models\NeededProduct;
use App\Observers\GenericObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar los Observers
        Product::observe(GenericObserver::class);
        Category::observe(GenericObserver::class);
        Place::observe(GenericObserver::class);
        ProductStatus::observe(GenericObserver::class);
        Unit::observe(GenericObserver::class);
        PurchasesHistoryHeader::observe(GenericObserver::class);
        PurchasesHistoryDetail::observe(GenericObserver::class);
        ChecklistHeader::observe(GenericObserver::class);
        ChecklistDetail::observe(GenericObserver::class);
    }
}
