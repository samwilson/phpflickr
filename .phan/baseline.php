<?php

return [
    'file_suppressions' => [
        'src/CamerasApi.php' => ['PhanUnextractableAnnotation'],
        'src/CollectionsApi.php' => ['PhanUnextractableAnnotation'],
        'src/CommonsApi.php' => ['PhanUnextractableAnnotation'],
        'src/ContactsApi.php' => ['PhanUnextractableAnnotation'],
        'src/FavoritesApi.php' => ['PhanUnextractableAnnotation'],
        'src/GalleriesApi.php' => ['PhanTypeMismatchDefault', 'PhanUnextractableAnnotation'],
        'src/GroupsApi.php' => ['PhanUnextractableAnnotation'],
        'src/GroupsDiscussRepliesApi.php' => ['PhanUnextractableAnnotation'],
        'src/GroupsDiscussTopicsApi.php' => ['PhanUnextractableAnnotation'],
        'src/GroupsMembersApi.php' => ['PhanUnextractableAnnotation'],
        'src/GroupsPoolsApi.php' => ['PhanUnextractableAnnotation'],
        'src/InterestingnessApi.php' => ['PhanUnextractableAnnotation'],
        'src/MachinetagsApi.php' => ['PhanUnextractableAnnotation'],
        'src/PandaApi.php' => ['PhanUnextractableAnnotation'],
        'src/PeopleApi.php' => ['PhanUnextractableAnnotation'],
        'src/PhotosApi.php' => ['PhanTypeMismatchDefault', 'PhanTypeMismatchForeach', 'PhanUnextractableAnnotation'],
        'src/PhotosCommentsApi.php' => ['PhanUnextractableAnnotation'],
        'src/PhotosGeoApi.php' => ['PhanUnextractableAnnotation'],
        'src/PhotosNotesApi.php' => ['PhanUnextractableAnnotation'],
        'src/PhotosPeopleApi.php' => ['PhanUnextractableAnnotation'],
        'src/PhotosSuggestionsApi.php' => ['PhanUnextractableAnnotation'],
        'src/PhotosTransformApi.php' => ['PhanUnextractableAnnotation'],
        'src/PhotosUploadApi.php' => ['PhanUnextractableAnnotation'],
        'src/PhotosetsCommentsApi.php' => ['PhanUnextractableAnnotation'],
        'src/PhpFlickr.php' => [
            'PhanInvalidCommentForDeclarationType', 'PhanTypeConversionFromArray', 'PhanTypeMismatchArgumentInternal',
            'PhanTypeMismatchProperty', 'PhanTypeMismatchReturnProbablyReal', 'PhanUndeclaredClassInstanceof',
            'PhanUndeclaredClassMethod', 'PhanUndeclaredMethod', 'PhanUndeclaredTypeParameter',
            'PhanUndeclaredTypeProperty', 'PhanUndeclaredTypeReturnType', 'PhanUnreferencedUseNormal'
        ],
        'src/PlacesApi.php' => ['PhanUnextractableAnnotation'],
        'src/PrefsApi.php' => ['PhanUnextractableAnnotation'],
        'src/PushApi.php' => ['PhanUnextractableAnnotation'],
        'src/ReflectionApi.php' => ['PhanUnextractableAnnotation'],
        'src/StatsApi.php' => ['PhanUnextractableAnnotation'],
        'src/TagsApi.php' => ['PhanUnextractableAnnotation'],
        'src/TestApi.php' => ['PhanUndeclaredClassCatch'],
        'src/TestimonialsApi.php' => ['PhanUnextractableAnnotation'],
        'src/Uploader.php' => [
            'PhanUndeclaredClassMethod', 'PhanUndeclaredProperty',
            'PhanUndeclaredTypeThrowsType', 'PhanUnreferencedUseNormal'
        ],
        'src/Util.php' => ['PhanParamSuspiciousOrder'],
    ],
];
