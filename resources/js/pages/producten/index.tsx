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
  category: Category | null;
};

type PaginatorLink = {
  url: string | null;
  label: string;
  active: boolean;
};

type ProductPaginator = {
  data: Product[];
  links: PaginatorLink[];
};

export default function Index(props: { products: ProductPaginator }) {
  const { products } = props;

  return (
    <>
      <Head title="Producten" />

      <div className="mx-auto max-w-5xl px-4 py-8">
        <h1 className="text-2xl font-semibold">Producten</h1>

        <div className="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
          {products.data.map((p) => (
            <Link
              key={p.id}
              href={`/producten/${p.slug}`}
              className="rounded-lg border p-4 hover:bg-gray-50"
            >
              <div className="text-sm text-gray-500">
                {p.category ? p.category.name : "Geen categorie"}
              </div>

              <div className="mt-1 font-medium">{p.name}</div>

              <div className="mt-2 text-sm">
                € {Number(p.price).toFixed(2)}
              </div>
            </Link>
          ))}
        </div>

        <div className="mt-8 flex flex-wrap gap-2">
          {products.links.map((l, i) => (
            <Link
              key={i}
              href={l.url ?? ""}
              disabled={!l.url}
              className={[
                "rounded border px-3 py-1 text-sm",
                l.active ? "bg-black text-white" : "bg-white",
                !l.url ? "pointer-events-none opacity-40" : "",
              ].join(" ")}
            >
              <span dangerouslySetInnerHTML={{ __html: l.label }} />
            </Link>
          ))}
        </div>
      </div>
    </>
  );
}