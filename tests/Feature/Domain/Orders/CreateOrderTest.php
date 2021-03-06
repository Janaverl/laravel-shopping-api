<?php

namespace Tests\Feature\Domain\Orders;

use Domain\Orders\CreateOrder;
use Domain\Orders\Order;
use Domain\Orders\OrderId;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class CreateOrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function itCreatesNewOrderWithGivenId(): void
    {
        $orderId = OrderId::generate();

        (new CreateOrder($orderId))->handle();

        $order = Order::id($orderId);

        $this->assertTrue($order->getId()->equals($orderId));
        $this->assertFalse($order->isNew());
        $this->assertFalse($order->isCheckedOut());
    }
}
