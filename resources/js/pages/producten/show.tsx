import React from "react";
import { Head, Link } from "@inertiajs/react";

type Category = {
  id: number;
  name: string;
  slug: string;
};

type Product = {
  id: number;
  name: string;
  slug: string;
  price: string | number;
  description: string | null;
  category: Category | null;
};

export default function Show(props: { product: Product }) {
  const { product } = props;

  return (
    <>
      <Head title={product.name} />

      <div className="mx-auto max-w-3xl px-4 py-8">
        <Link href="/producten" className="text-sm underline">
          ← Terug naar producten
        </Link>

        <h1 className="mt-4 text-2xl font-semibold">{product.name}</h1>

        <div className="mt-2 text-sm text-gray-600">
          {product.category ? product.category.name : "Geen categorie"}
        </div>

        <div className="mt-4 text-lg font-medium">
          € {Number(product.price).toFixed(2)}
        </div>

        {product.description ? (
          <p className="mt-6 leading-relaxed">{product.description}</p>
        ) : (
          <p className="mt-6 text-gray-500">Geen beschrijving.</p>
        )}
      </div>
    </>
  );
}