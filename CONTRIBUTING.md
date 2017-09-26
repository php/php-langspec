## Contributing to the Specification for PHP

We'd love your help in improving, correcting, adding to the specification.
Please [file an issue](https://github.com/php/php-langspec/issues)
or [submit a pull request](https://github.com/php/php-langspec/pulls).

## Generated content

The grammar listings and table of contents of the specification are automatically
generated. If you want to change the grammar, you need to modify the respective
`<!--GRAMMAR` block and run `tools/grammar.php` to regenerate the rendered listings.
If you add or change headings, you need to regenerate the TOC using `tools/toc.php`.
Additionally `tools/check_refs.php` can be run to verify that all cross-references
are valid.

To combine these three steps you can instead execute `tools/pre-commit`. To
automatically run it on every commit, create a symlink in the `.git/hooks` directory:

```sh
ln -s -f ../../tools/pre-commit .git/hooks/pre-commit
```

## License for your Contributions

Any contribution you provide to the Specification for PHP must adhere to the
same license as stated in the [LICENSE](LICENSE).
