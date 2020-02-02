<?php

namespace Domain\Orders;

use Domain\Products\ProductId;
use Illuminate\Foundation\Bus\Dispatchable;

final class AddLineItemToOrder
{
    use Dispatchable;

    /**
     * @var LineItemId
     */
    private $lineItemId;

    /**
     * @var OrderId
     */
    private $orderId;

    /**
     * @var ProductId
     */
    private $productId;

    public function __construct(
        LineItemId $lineItemId,
        OrderId $orderId,
        ProductId $productId
    ) {
        $this->lineItemId = $lineItemId;
        $this->orderId = $orderId;
        $this->productId = $productId;
    }

    public function getLineItemId(): LineItemId
    {
        return $this->lineItemId;
    }

    public function getOrderId(): OrderId
    {
        return $this->orderId;
    }

    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    public function handle()
    {
        Order::findOrCreate($this->orderId)
            ->recordThat(new LineItemWasAddedToOrder(
                $this->lineItemId,
                $this->orderId,
                $this->productId
            ))
            ->persist();
    }
}