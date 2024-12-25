<?php
namespace Sdk\Dictionary\Item\Model;

use Sdk\Dictionary\Item\Repository\ItemRepository;

class ItemMock extends Item
{
    public function getRepositoryPublic() : ItemRepository
    {
        return parent::getRepository();
    }
}
