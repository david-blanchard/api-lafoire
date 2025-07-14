<?php

namespace App\Entity\Campaign;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Campaign;
use App\Entity\CampaignProduct;
use App\Entity\Product\ClothProduct;
use App\Entity\ProductInterface;
use App\Repository\ClothProductCampaignRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(mercure: true)]
#[ORM\Entity(repositoryClass: ClothProductCampaignRepository::class)]
#[ORM\Table(name: 'cloth_campaign_product')]
class ClothProductCampaign extends CampaignProduct
{
    public readonly string $campaign_type;

    public function __construct()
    {
        parent::__construct();
        $this->campaign_type = ClothProductCampaign::class;
    }

    // Additional methods specific to ClothProductCampaign can be added here
    #[Groups(['campaign_product.read', 'campaign_product.write'])]
    public function setProduct(ProductInterface|null $product): self
    {
        if ($product) {
            $this->products->add($product);
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductInterface|null>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }
}
