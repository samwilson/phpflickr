<?php

namespace Samwilson\PhpFlickr\Tests\ApiMethodGroup;

use DateTime;
use Samwilson\PhpFlickr\PhpFlickr;
use Samwilson\PhpFlickr\Tests\TestCase;
use Samwilson\PhpFlickr\Util;

class PhotosApiTest extends TestCase
{
    /** @var int */
    protected $testPhotoId;

    protected function getTestPhotoId(PhpFlickr $flickr)
    {
        if ($this->testPhotoId) {
            return $this->testPhotoId;
        }
        $testFilename = dirname(__DIR__) . '/../examples/Agateware_Example.JPG';
        $photo = $flickr->uploader()->upload($testFilename);
        $this->testPhotoId = $photo['photoid'];
        return $this->testPhotoId;
    }

    /**
     * @group auth
     */
    public function testAddTags()
    {
        $flickr = $this->getFlickr(true);
        $testFilename = dirname(__DIR__) . '/../examples/Agateware_Example.JPG';
        $photo = $flickr->uploader()->upload($testFilename);

        // Add a string of tags.
        $tagString = 'Tag Iñtërnâtiônàlizætiøn "Third Tag"';
        $tagsAdded1 = $flickr->photos()->addTags($photo['photoid'], $tagString);
        static::assertTrue($tagsAdded1);
        $photoInfo = $flickr->photos()->getInfo($photo['photoid']);
        static::assertCount(3, $photoInfo['tags']['tag']);
        $tags1 = [];
        foreach ($photoInfo['tags']['tag'] as $tagInfo) {
            $tags1[] = $tagInfo['raw'];
        }
        static::assertEquals(['Tag', 'Iñtërnâtiônàlizætiøn', 'Third Tag'], $tags1);

        // Add an array of tags.
        $tagsAdded2 = $flickr->photos()->addTags($photo['photoid'], ['Four', '"With quotes"']);
        static::assertTrue($tagsAdded2);
        $photoInfo2 = $flickr->photos()->getInfo($photo['photoid']);
        static::assertCount(5, $photoInfo2['tags']['tag']);
        $tags2 = [];
        foreach ($photoInfo2['tags']['tag'] as $tagInfo) {
            $tags2[] = $tagInfo['raw'];
        }
        static::assertEquals(
            ['Tag', 'Iñtërnâtiônàlizætiøn', 'Third Tag', 'Four', 'With quotes'],
            $tags2
        );

        // Clean up.
        $flickr->photos()->delete($photo['photoid']);
    }

    public function testSetTags()
    {
        $flickr = $this->getFlickr(true);
        $testPhotoId = $this->getTestPhotoId($flickr);

        $photoInfo = $flickr->photos()->getInfo($testPhotoId);
        static::assertCount(0, $photoInfo['tags']['tag']);

        $tagString = 'Tag Iñtërnâtiônàlizætiøn "Third Tag"';
        $tagsResult = $flickr->photos()->setTags($testPhotoId, $tagString);
        static::assertTrue($tagsResult);

        $photoInfo = $flickr->photos()->getInfo($testPhotoId);
        static::assertCount(3, $photoInfo['tags']['tag']);
    }

    public function testSearch()
    {
        $flickr = $this->getFlickr(true);
        $testTitle = uniqid('PhpFlickr search test ');
        $searchParams = [
            'user_id' => 'me',
            'text' => $testTitle,
        ];

        // Make sure there are no search results to start with.
        $search = $flickr->photos()->search($searchParams);
        static::assertCount(0, $search['photo']);

        // Upload a test photo.
        $testFilename = dirname(__DIR__) . '/../examples/Agateware_Example.JPG';
        $photo = $flickr->uploader()->upload($testFilename, $testTitle, null, null, true, null, null, null, 1);

        // Look for search results, looping because it's a new file and can take time to be indexed.
        for ($i = 0; $i < 15; $i++) {
            sleep(1);
            $search = $flickr->photos()->search($searchParams);
            if (count($search['photo']) > 0) {
                break;
            }
        }
        static::assertGreaterThanOrEqual(1, count($search['photo']));

        // Clean up.
        $flickr->photos()->delete($photo['photoid']);
    }

    public function testSetMeta()
    {
        $flickr = $this->getFlickr(true);
        $testPhotoId = $this->getTestPhotoId($flickr);

        // Set title and description on a known photo, and check them in a 2nd request.
        $metaResponse = $flickr->photos()->setMeta($testPhotoId, 'New title', 'New description');
        static::assertTrue($metaResponse);
        $info = $flickr->photos()->getInfo($testPhotoId);
        static::assertEquals('New title', $info['title']);
        static::assertEquals('New description', $info['description']);

        // Test for an error with an invalid photo ID.
        static::expectExceptionMessage('Photo "1" not found (invalid ID)');
        $flickr->photos()->setMeta(1, 'Lorem');

        // Clean up.
        $flickr->photos()->delete($testPhotoId);
    }

    public function testSetDates()
    {
        $flickr = $this->getFlickr(true);
        $testPhotoId = $this->getTestPhotoId($flickr);

        $datesResponse = $flickr->photos()->setDates(
            $testPhotoId,
            new DateTime('2019-02-10 13:24'),
            Util::DATE_GRANULARITY_YEAR
        );
        static::assertTrue($datesResponse);
        $info = $flickr->photos()->getInfo($testPhotoId);
        static::assertEquals('2019-01-01 00:00:00', $info['dates']['taken']);
        static::assertEquals(6, $info['dates']['takengranularity']);

        // Clean up.
        $flickr->photos()->delete($testPhotoId);
    }
}
