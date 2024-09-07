<?php

declare(strict_types=1);

namespace App\Handler\ProductRelatedHandler;


use Admin\Services\Product\ProductService;
use App\Form\CheckOutForm;
use App\Form\GiftForm;
use App\Services\CartPriceService;
use App\Services\CartService;
use App\Services\UserService\PresentAddressService;
use App\Services\UserService\UserAddressService;
use App\Services\UserService\UserProductCartService;
use App\Services\UserService\UserPurchaseInfoService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Form\FormInterface;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CheckOutPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private CartService $cartService,
        private UserAddressService $userAddressService,
        private PresentAddressService $presentAddressService,
        private UrlHelper $urlHelper,
        private CartPriceService $cartPriceService,
        private UserProductCartService $userProductCartService,
        private ProductService $productService,
        private UserPurchaseInfoService $userPurchaseInfoService,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $session = $_COOKIE['PHPSESSID'];

        if (isset($_SESSION['user_email'])) {
            $session = $_SESSION['user_email'];
        }

        $productIds = $this->cartService->selectCart($session);
        $productIdsCollection = [];

        foreach ($productIds as $item) {
            $productIdsCollection [] = (int)$item['product_id'];
        }
        $finalProductIdsCollection = (implode(',', $productIdsCollection));

        foreach ($productIdsCollection as $productId) {
            $productOutputs[] = $this->cartPriceService->getALLCartByproductIds($productId);
        }

        foreach ($productOutputs as $items) {
            foreach ($items as $product) {
                $productOutput[] = $product;
            }
        }

        $total = 0;
        foreach ($productOutput as $item) {
            $total += (int)$item['price'];
        }
        // end get request
        //post
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $postedData = $request->getParsedBody();
            $presentAddressId = null;
            $checkOutForm = new CheckOutForm();
            $checkOutForm->setData($postedData);


            if ($checkOutForm->isValid()) {
                $checkOutData = $checkOutForm->getData(FormInterface::VALUES_AS_ARRAY);

                $products = $this->productService->getALLProductByIds($finalProductIdsCollection);
                foreach ($products as $product) {
                    $this->userProductCartService->addProduct(
                        $product['name'],
                        $product['label'],
                        $product['brand_name'],
                        $product['description'],
                        $product['price'],
                        $product['height'],
                        $product['width'],
                        $product['category_name'],
                        $product['package'],
                        $product['material_name'],
                        $total,
                        $session
                    );
                }

                if ($postedData['shipingAddress'] === 'true') {
                    $presentAddressId = $this->presentAddressService->addPresentAddress(
                        $postedData['firstName2'],
                        $postedData['email2'],
                        $postedData['address2'],
                        $postedData['city2'],
                        $postedData['country2'],
                        (int)$postedData['zipCode2'],
                        (int)$postedData['tel2']
                    );
                }
                $productsId = $this->userProductCartService->getALLUserProductByIds($session);


                $Billing = $this->userAddressService->addBillingAddress
                (
                    $checkOutData['firstName'],
                    $checkOutData['email'],
                    $checkOutData['address'],
                    $checkOutData['city'],
                    $checkOutData['country'],
                    (int)$checkOutData['zipCode'],
                    (int)$checkOutData['tel']
                    ,
                    $finalProductIdsCollection,
                    $session,
                    $presentAddressId
                );

                foreach ($productsId as $productItem) {
                    $this->userPurchaseInfoService->addPurchaseInfo($productItem['id'], $Billing, $session);
                }
                $this->cartService->deleteCart($finalProductIdsCollection, $session);
                $this->cartPriceService->deleteCart($finalProductIdsCollection, $session);
                return new JsonResponse(['url' => $this->urlHelper->generate('checkout')]);
            }

            return new JsonResponse($checkOutForm->getMessages());
        }
        //end post


        $data = [
            'products' => $productOutput,
            'cartProduct' => $productOutput,
            'totalPrice' => $total,
        ];

        return new HtmlResponse(
            $this->template->render(
                'product::checkout',
                $data
            )
        );
    }
}
