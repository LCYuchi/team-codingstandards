# team-codingstandards
Coding Standards for PHP8.3 + CodeIgniter4.5 on VSCode

## 対応するファイル種別

| ファイル | フォーマッタ |
|---|---|
| `.php` | php-cs-fixer |
| `.js` | Prettier |
| `.css` | Prettier |
| `.twig` | 対象外（`.editorconfig` で最低限カバー） |

## フォーマットルール

| ルール | 設定値 |
|---|---|
| インデント | タブ |
| 改行コード | LF |
| 1行の最大文字数 | 120文字 |
| 引用符（PHP） | シングルクォート（変数展開時はダブルクォート） |
| 引用符（JS・CSS） | ダブルクォート |
| 末尾セミコロン（JS） | あり |
| 末尾カンマ（JS） | あり |

---

## 初回セットアップ

### 1. VSCode 拡張機能をインストールする

以下の拡張機能をインストールしてください。

- [PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client)
- [PHP CS Fixer](https://marketplace.visualstudio.com/items?itemName=junstyle.php-cs-fixer)（作者: junstyle）
- [Prettier - Code formatter](https://marketplace.visualstudio.com/items?itemName=esbenp.prettier-vscode)

### 2. php-cs-fixer をグローバルインストールする

```bash
composer global require friendsofphp/php-cs-fixer:^3.0
```

インストール後、Composer の bin ディレクトリにパスを通してください。

```bash
# Composer の bin ディレクトリを確認
composer global config bin-dir --absolute
```

表示されたパスを `~/.zshrc` または `~/.bashrc` に追加します。

```bash
export PATH="/Users/yourname/.composer/vendor/bin:$PATH"
```

追加したらシェルを再読み込みします。

```bash
source ~/.zshrc  # または ~/.bashrc
```

動作確認します。

```bash
php-cs-fixer --version
# PHP CS Fixer 3.x.x ...
```

### 3. VSCode ユーザー設定に php-cs-fixer のパスを追加する

`Ctrl+Shift+P`（Mac は `Cmd+Shift+P`）→「設定を開く（JSON）」を開き、以下を追記します。

```json
{
  "php-cs-fixer.executablePath": "/Users/yourname/.composer/vendor/bin/php-cs-fixer"
}
```

### 4. 設定ファイルをプロジェクトにコピーする

このリポジトリから以下のファイルをプロジェクトのルートにコピーします。

```
.editorconfig
.prettierrc
.prettierignore
.php-cs-fixer.php
```

サブモジュールの場合はサブモジュールのルートにコピーしてください。

### 5. `.gitignore` に `node_modules/` を追記する

```
# Node.js
node_modules/
```

### 6. Prettier プラグインをインストールする

```bash
cd /path/to/project
npm install
```

### 7. 親プロジェクトに `.vscode/settings.json` を作成する

VSCode で親プロジェクトのルートを開いている場合、`.vscode/settings.json` を作成して以下を記述します。

```json
{
  "editor.formatOnSave": true,
  "editor.insertSpaces": false,
  "editor.defaultFormatter": "esbenp.prettier-vscode",
  "editor.rulers": [120],

  "[php]": {
    "editor.defaultFormatter": "junstyle.php-cs-fixer"
  },
  "[twig]": {
    "editor.defaultFormatter": "esbenp.prettier-vscode"
  },
  "[javascript]": {
    "editor.defaultFormatter": "esbenp.prettier-vscode"
  },
  "[css]": {
    "editor.defaultFormatter": "esbenp.prettier-vscode"
  },

  "php-cs-fixer.config": "path/to/subproject/.php-cs-fixer.php"
}
```

> `php-cs-fixer.config` はワークスペースルートからの相対パスで指定します。
> `.vscode/` は `.gitignore` に含まれているため、**この作業は各自のローカルで行います**。

### 8. VSCode を開き直す

設定を反映させるため VSCode を再起動します。

---

## 初回フォーマットの適用

セットアップ完了後、既存コードに一括フォーマットを適用します。
**必ず単独のコミットとして記録してください。**

```bash
cd /path/to/project

# JS・CSS を一括フォーマット
npx prettier --write "public/**/*.{js,css}"

# PHP を一括フォーマット
php-cs-fixer fix --config=.php-cs-fixer.php

# 差分を確認
git diff

# 単独コミット
git add -A
git commit -m "style: apply initial formatter (php-cs-fixer + prettier)"
```

---

## 日常の使い方

`editor.formatOnSave: true` が設定されている場合、ファイル保存時に自動フォーマットがかかります。

手動でフォーマットしたい場合は以下を使用します。

- **VSCode**: `Shift+Alt+F`（Mac は `Shift+Option+F`）→「ドキュメントのフォーマット」
- **CLI（JS・CSS）**: `npx prettier --write "public/**/*.{js,css}"`
- **CLI（PHP）**: `php-cs-fixer fix --config=.php-cs-fixer.php`

---

## リポジトリ構成

```
team-codingstandard/
├── .editorconfig          # 全エディタ共通の基盤ルール
├── .prettierrc            # Prettier 設定（JS・CSS）
├── .prettierignore        # Prettier 除外設定
├── .php-cs-fixer.php      # php-cs-fixer 設定（PHP）
├── .gitignore
├── package.json           # Prettier プラグインのバージョン管理
└── README.md
```
