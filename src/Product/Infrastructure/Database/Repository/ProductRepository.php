<?php

namespace App\Product\Infrastructure\Database\Repository;

use App\Product\Domain\Entity\Product;
use App\Product\Application\Boundary\ProductRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    protected $sizeRepository;
    protected $descriptionRepository;

    public function __construct(ManagerRegistry $registry, SizeRepository $sizeRepository, DescriptionRepository $descriptionRepository)
    {
        $this->sizeRepository = $sizeRepository;
        $this->descriptionRepository = $descriptionRepository;
        parent::__construct($registry, Product::class);
    }
    public function getProducts()
    {
        return $this->findAll();
    }

    public function getProductByUuid($uuid)
    {
        return $this->findOneBy(['id' => $uuid]);
    }

    public function deleteProduct($uuid)
    {
        $this->getEntityManager()->remove($this->getProductByUuid($uuid));
        $this->getEntityManager()->flush();
    }

    public function createProduct($data)
    {
        $product = new Product();
        $product->setName($data['name']);
        $product->setArticle($data['article']);

        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();
    }

    public function updateProduct($data)
    {
        $product = $this->getProductByUuid($data['uuid']);
        $product->setName($data['name']);
        $product->setArticle($data['article']);
        $this->getEntityManager()->flush();
    }
}
