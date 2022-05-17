<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Coupon;

class CouponApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_coupon()
    {
        $coupon = Coupon::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/coupons', $coupon
        );

        $this->assertApiResponse($coupon);
    }

    /**
     * @test
     */
    public function test_read_coupon()
    {
        $coupon = Coupon::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/coupons/'.$coupon->id
        );

        $this->assertApiResponse($coupon->toArray());
    }

    /**
     * @test
     */
    public function test_update_coupon()
    {
        $coupon = Coupon::factory()->create();
        $editedCoupon = Coupon::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/coupons/'.$coupon->id,
            $editedCoupon
        );

        $this->assertApiResponse($editedCoupon);
    }

    /**
     * @test
     */
    public function test_delete_coupon()
    {
        $coupon = Coupon::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/coupons/'.$coupon->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/coupons/'.$coupon->id
        );

        $this->response->assertStatus(404);
    }
}
