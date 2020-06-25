<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Bookmark;
use Authorization\IdentityInterface;

/**
 * Bookmark policy
 */
class BookmarkPolicy
{
    /**
     * Check if $user can create Bookmark
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Bookmark $bookmark
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Bookmark $bookmark)
    {
        // All logged in users can create bookmarks.
        return true;
    }

    /**
     * Check if $user can update Bookmark
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Bookmark $bookmark
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Bookmark $bookmark)
    {
        // logged in users can edit their own bookmark.
        return $this->isAuthor($user, $bookmark);
    }

    /**
     * Check if $user can delete Bookmark
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Bookmark $bookmark
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Bookmark $bookmark)
    {
        // logged in users can edit their own bookmark.
        return $this->isAuthor($user, $bookmark);
    }

    /**
     * Check if $user can view Bookmark
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Bookmark $bookmark
     * @return bool
     */
    public function canView(IdentityInterface $user, Bookmark $bookmark)
    {
        // All logged in users can create bookmarks.
        return true;
    }
    protected function isAuthor(IdentityInterface $user, Bookmark $bookmark)
    {
        return $bookmark->user_id === $user->getIdentifier();
    }
}
