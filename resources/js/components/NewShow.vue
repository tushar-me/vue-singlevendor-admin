<template>
    <div>
        <CategoryList :flattenedCategories="flattenedCategories" />
    </div>
</template>
  
<script>
import { defineComponent, computed } from 'vue';

export default defineComponent({
    data() {
        return {
            categories: [
                {
                    "id": 6,
                    "parent_id": 0,
                    "name": "Parent Again",
                    "slug": "parent-again",
                    "photo": "\/storage\/category\/9XpLZRnsfrf08iGMCfRhqq5LXUIximl4HBJEVUQB.jpg",
                    "description": "ddd",
                    "details": "undefined",
                    "status": "active",
                    "created_at": "2024-01-20T13:10:27.000000Z",
                    "updated_at": "2024-01-20T13:10:27.000000Z",
                    "children_recursive": [],
                    "parent_category": null
                },
                {
                    "id": 5,
                    "parent_id": 4,
                    "name": "sub tow",
                    "slug": "sub-tow",
                    "photo": "\/storage\/category\/cwSNFzGjMLlfFrDdQibQkPN68lYaoKG3QwdEZTfB.jpg",
                    "description": "asdfasdf",
                    "details": "undefined",
                    "status": "active",
                    "created_at": "2024-01-20T12:54:25.000000Z",
                    "updated_at": "2024-01-20T12:54:25.000000Z",
                    "children_recursive": [],
                    "parent_category": {
                        "id": 4,
                        "parent_id": 1,
                        "name": "sub one",
                        "slug": "sub-one",
                        "photo": "\/storage\/category\/hUHTsraVQCAWCsVx8lFGRGwgIgBAySaSYAvDFSDg.jpg",
                        "description": "asdfasdf",
                        "details": "undefined",
                        "status": "active",
                        "created_at": "2024-01-20T12:54:01.000000Z",
                        "updated_at": "2024-01-20T12:54:01.000000Z"
                    }
                },
                {
                    "id": 4,
                    "parent_id": 1,
                    "name": "sub one",
                    "slug": "sub-one",
                    "photo": "\/storage\/category\/hUHTsraVQCAWCsVx8lFGRGwgIgBAySaSYAvDFSDg.jpg",
                    "description": "asdfasdf",
                    "details": "undefined",
                    "status": "active",
                    "created_at": "2024-01-20T12:54:01.000000Z",
                    "updated_at": "2024-01-20T12:54:01.000000Z",
                    "children_recursive": [
                        {
                            "id": 5,
                            "parent_id": 4,
                            "name": "sub tow",
                            "slug": "sub-tow",
                            "children_recursive": []
                        }
                    ],
                    "parent_category": {
                        "id": 1,
                        "parent_id": 0,
                        "name": "ERGONOMIC OFFICE FURNITURE",
                        "slug": "ergonomic-office-furniture",
                        "photo": "\/storage\/category\/dT4OTVZ1Mo76Ec4M5ZNYgQTG5FaJAtc1X6BR8BR4.webp",
                        "description": "Increase your productivity with a workspace designed to improve both your movement and your performance.",
                        "details": "undefined",
                        "status": "active",
                        "created_at": "2024-01-20T12:43:44.000000Z",
                        "updated_at": "2024-01-20T12:43:44.000000Z"
                    }
                },
                {
                    "id": 3,
                    "parent_id": 0,
                    "name": "first sub cat",
                    "slug": "first-sub-cat",
                    "photo": "\/storage\/category\/ETv5I8SEnWGcqv1QSizOuWQ6nyFz9tVhPYjgS9up.webp",
                    "description": "ddd",
                    "details": "undefined",
                    "status": "active",
                    "created_at": "2024-01-20T12:48:15.000000Z",
                    "updated_at": "2024-01-20T12:48:15.000000Z",
                    "children_recursive": [],
                    "parent_category": null
                },
                {
                    "id": 2,
                    "parent_id": 0,
                    "name": "First Sub",
                    "slug": "first-sub",
                    "photo": "\/storage\/category\/882RMYpZbuVwDzGf62z5LsNG8KSidNnD9NAPFZZ6.webp",
                    "description": "ddd",
                    "details": "undefined",
                    "status": "active",
                    "created_at": "2024-01-20T12:47:46.000000Z",
                    "updated_at": "2024-01-20T12:47:46.000000Z",
                    "children_recursive": [],
                    "parent_category": null
                },
                {
                    "id": 1,
                    "parent_id": 0,
                    "name": "ERGONOMIC OFFICE FURNITURE",
                    "slug": "ergonomic-office-furniture",
                    "photo": "\/storage\/category\/dT4OTVZ1Mo76Ec4M5ZNYgQTG5FaJAtc1X6BR8BR4.webp",
                    "description": "Increase your productivity with a workspace designed to improve both your movement and your performance.",
                    "details": "undefined",
                    "status": "active",
                    "created_at": "2024-01-20T12:43:44.000000Z",
                    "updated_at": "2024-01-20T12:43:44.000000Z",
                    "children_recursive": [
                        {
                            "id": 4,
                            "parent_id": 1,
                            "name": "sub one",
                            "slug": "sub-one",
                            "children_recursive": [
                                {
                                    "id": 5,
                                    "parent_id": 4,
                                    "name": "sub tow",
                                    "slug": "sub-tow",
                                    "children_recursive": []
                                }
                            ]
                        }
                    ],
                    "parent_category": null
                }
            ],
        };
    },
    computed: {
        flattenedCategories() {
            return this.flattenCategories(this.categories);
        },
    },
    methods: {
        flattenCategories(categories, level = 0, parentPrefix = "") {
            return categories?.reduce((result, category) => {
                const prefix = level > 0 ? `${parentPrefix}-` : parentPrefix;
                const fullName = `${prefix} ${category.name}`;
                const flattenedCategory = { ...category, fullName };
                result.push(flattenedCategory);

                if (category.children_recursive && category.children_recursive.length > 0) {
                    result.push(...this.flattenCategories(category.children_recursive, level + 1, prefix));
                }
                return result;
            }, []);
        },
    },
    components: {
        CategoryList: defineComponent({
            props: ['flattenedCategories'],
            template: `
          <ul>
            <li v-for="category in flattenedCategories" :key="category.id">
              {{ getCategoryPrefix(category.level) }} {{ category.name }}
            </li>
          </ul>
        `,
            methods: {
                getCategoryPrefix(level) {
                    return Array(level).fill('-').join('');
                },
            },
        }),
    },
});
</script>
  