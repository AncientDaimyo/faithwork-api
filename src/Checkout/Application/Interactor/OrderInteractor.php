<?

namespace App\Checkout\Application\Interactor;

use App\Checkout\Domain\Entity\Order;
use App\Checkout\Domain\Entity\OrderItem;
use App\Checkout\Application\DTO\OrderDTO;
use App\Product\Application\Boundary\ProductRepositoryInterface;

class OrderInteractor
{
    public function makeOrder(OrderDTO $checkoutData, $registry, $productRepository)
    {
        

        $order = new Order();

        $cartItems = $checkoutData;
        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItem();
            $orderItem->setProduct(ProductRepositoryInterface::getProductFromRepositoryByUuid($productRepository, $cartItem->getUuid()));
            $orderItem->setQuantity((int)$cartItem->getQuantity());
            $orderItem->setSize($doctrine->getRepository(Size::class)->findOneBy(['size' => $cartItem['size']]));
            $orderItem->setOrderObj($order);
            $order->addOrderItem($orderItem);
            $entityManager->persist($orderItem);
        }

        

        $customer->addOrder($order);
        $entityManager->persist($order);
        $entityManager->persist($customer);
        $entityManager->flush();
        return true;
    }
}
